<?php

namespace tutoria\Http\Controllers\Auth;

use DB;
use Auth;
use tutoria\User;
use tutoria\Usudoc;
use tutoria\Usuest;
use tutoria\Usunapnet;
use Validator;
use tutoria\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = 'index';

    protected $username = "username";

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    protected function isPasswd($passwdDB, $passwdIn) {
        $passwords = DB::select('select password(?) as passwd', [$passwdIn]);
        if($passwdDB === $passwords[0]->passwd) {
            return true;
        }
        else {
            return false;
        }
    }
    protected function signin(Request $request) {
        $usu = Usunapnet::where('username', $request->username)->first();
        if ($usu != null && $this->isPasswd($usu->passwd, $request->password)) {
            $usutut = User::where('username', $request->username)->first();
            if($usutut != null) {
                //------------------------------
                $usutut->password = bcrypt($request->password);
                $usutut->save();
                //----------------------------
                return $this->login($request);
            }
            else {
                $usunew = new User();
                $usunew->name = $usu->name;
                $usunew->email = $usu->email;
                $usunew->username = $usu->username;
                $usunew->codigo = $usu->codigo;
                $usunew->cod_car = $usu->cod_car;
                $usunew->password = bcrypt($request->password);
                $usunew->type = $usu->type;
                $usunew->save();
                return $this->login($request);
            }
        }    
        else {
            return $this->login($request);
        } 
    }
}
