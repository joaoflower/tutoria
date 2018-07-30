<?php

namespace tutoria\Http\Controllers;

use Illuminate\Http\Request;

use tutoria\Http\Requests;

use Illuminate\Support\Collection;
use Auth;
use tutoria\Http\Requests\SesgruRequest;
use tutoria\Http\Requests\SesgruImgRequest;

use tutoria\Grupo;
use tutoria\Tutor;
use tutoria\Estugrupo;
use tutoria\Sesgru17;
use tutoria\Sesgru17av;
use tutoria\Sesgru17img;

use Laracasts\Flash\Flash;

class SesgruController extends Controller
{
	private $ano_aca = '2018';
	private $per_aca = '01';
    private $grupo;
    private $tutor;

    public function __construct()
    {
        $this->middleware('auth');
        $this->grupo = Grupo::select('id')
            ->where('cod_prf', Auth::user()->codigo)->where('ano_aca', $this->ano_aca)->where('per_aca', $this->per_aca)
            ->first();
        $this->tutor = Tutor::find(Auth::user()->codigo);
    }
    public function index(Request $request) {
        if($this->tutor != null) {
            # Verificar si tiene grupo 
            if($this->grupo != null) { 
                return view('sesgru.index')->with('sesgrus', $this->grupo->sesgru17s);
            } 
            return view('nohayestu');
        } 
        return redirect()->route('perfild.create');
	}
    public function create() {
        # Obteniendo la lista de los tutorados
        $estugrupos = Estugrupo::where( 'grupo_id', $this->grupo->id )
            ->leftJoin('unapnet.carrera', 'estugrupo.cod_car', '=', 'carrera.cod_car')
            ->leftJoin('unapnet.estudiante', 'estugrupo.num_mat', '=', 'estudiante.num_mat')
            ->select('estugrupo.id', 'carrera.car_des', 'estugrupo.num_mat', 'estudiante.paterno', 'estudiante.materno', 'estudiante.nombres')
            ->orderBy('estudiante.paterno', 'asc')
            ->get();
        # Generando el numero de sesión
        $count = Sesgru17::where( 'grupo_id', $this->grupo->id )->count();        
        $nro_ses = $count + 1;

        return view('sesgru.create')
            ->with('estugrupos', $estugrupos)->with('nro_ses', $nro_ses);
    }
    public function uploadImg( SesgruImgRequest $request ) {
        $folder = '/175c687854099c6656b688aff89f27dce39a0cb4/';
        $path = public_path().$folder;
        $file = $request->file('file');
        $fileExt = $file->getClientOriginalExtension();
        $fileName = sha1(time().time()).".{$fileExt}";
        $fileSize = $file->getClientSize();
        $fileMime = $file->getClientMimeType();
        $file->move($path, $fileName);
        # Crea sesgru si no existe
        if( isset( $request->nro_ses ) ) {
            $sesgru = Sesgru17::where( 'grupo_id', $this->grupo->id )->where( 'nro_ses', $request->get('nro_ses') )->first();
            if( $sesgru == null ) {
                $sesgru = new Sesgru17($request->all());
                $sesgru->grupo_id = $this->grupo->id;
                $sesgru->save();
            }
        } elseif ( isset( $request->sesgru_id ) ) {
            $sesgru = Sesgru17::find( $request->get('sesgru_id') );
        }
        # new image
        $sesgru17img = new Sesgru17img();
        $sesgru17img->sesgru17()->associate($sesgru);
        $sesgru17img->url = $folder.$fileName;
        $sesgru17img->size = $fileSize;
        $sesgru17img->mime = $fileMime;
        $sesgru17img->save();

    }
    public function store( SesgruRequest $request ) {
    	# Busca y actualiza la sesgru, y si no existe lo crea
        
            $sesgru = Sesgru17::where( 'grupo_id', $this->grupo->id )->where( 'nro_ses', $request->get('nro_ses') )->first();
            if( $sesgru == null ) {
               $sesgru = new Sesgru17($request->all());
               $sesgru->grupo_id = $this->grupo->id;
            } else {
                $sesgru->fecha = $request->get('fecha');
            }
            $sesgru->save();
        # ------------------------
        foreach ($request->asi_ests as $estugrupo_id => $asi_est) {
          	$sesgru17av = new Sesgru17av();
          	$sesgru17av->sesgru17()->associate($sesgru);
          	$sesgru17av->estugrupo_id = $estugrupo_id;
          	$sesgru17av->asi_est = $asi_est;
          	$sesgru17av->valoracion = $request->valoraciones[$estugrupo_id];
          	$sesgru17av->save();
        }
        Flash::success('Se ha guardado la sesión de forma satisfactoria !');

        return redirect()->route('sesgru.index');
    }    
    public function show($id) {
        
    }
    public function edit( $id ) {
        $sesgru = Sesgru17::find( $id );
        $sesgru17avs = Sesgru17av::where( 'sesgru17_id', $id )
            ->leftJoin('estugrupo', 'sesgru17av.estugrupo_id', '=', 'estugrupo.id')
            ->leftJoin('unapnet.carrera', 'estugrupo.cod_car', '=', 'carrera.cod_car')
            ->leftJoin('unapnet.estudiante', 'estugrupo.num_mat', '=', 'estudiante.num_mat')
            ->select('sesgru17av.id', 'sesgru17av.sesgru17_id', 'carrera.car_des', 'estugrupo.num_mat', 'estudiante.paterno', 'estudiante.materno', 'estudiante.nombres', 'sesgru17av.asi_est', 'sesgru17av.valoracion')
            ->orderBy('estudiante.paterno', 'asc')
            ->get();

        $sesgru17imgs = Sesgru17img::where( 'sesgru17_id', $id )->get();
        $imgjson = array();
        foreach( $sesgru17imgs as $sesgru17img ) {
            $imgjson[] = [
                'original' => 'Foto',
                'size' => $sesgru17img->size,
                'filename' => $sesgru17img->url
            ];
        }

        return view('sesgru.edit')->with('sesgru', $sesgru)->with('sesgru17avs', $sesgru17avs)->with('imgjson', json_encode(['images' => $imgjson]) );
    }
    public function update(SesgruRequest $request, $id) {
        $sesgru = Sesgru17::find($id);
        $sesgru->fill($request->all());
        $sesgru->save();

        $sesgru->sesgru17avs;

        foreach ($sesgru->sesgru17avs as $sesgru17av) {
            $sesgru17av->asi_est = $request->asi_ests[ $sesgru17av->id ];
            $sesgru17av->valoracion = $request->valoraciones[ $sesgru17av->id ];
            $sesgru17av->save();
        }
        Flash::success('Se ha editado la sesión de forma satisfactoria !');

        return redirect()->route('sesgru.index');
    }
    public function destroy($id) {

    }
    public function dropSesgru(Request $request, $id) {
        if($request->ajax()) {
            $sesgru = Sesgru17::find($id);

            foreach ($sesgru->sesgru17avs as $sesgru17av ) {
                $sesgru17av->delete();
            }
            foreach ($sesgru->sesgru17imgs as $sesgru17img ) {
                $sesgru17img->delete();
            }
            $sesgru->delete();

            # ------
            $sesgrus = null;
            $grupo = Grupo::where('cod_prf', Auth::user()->codigo)->where('ano_aca', $this->ano_aca)->where('per_aca', $this->per_aca)->first();
            if($grupo != null) { 
                if($grupo->estugrupos->count() > 0) {
                    $sesgrus = $grupo->sesgru17s;
                }
            }
            #----------------
            return view('sesgru.index-sesgru')->with('sesgrus', $sesgrus);
        }
    }

}
