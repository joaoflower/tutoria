@extends('layouts.app17')

@section('title','Bienvenido')

@section('content')
        <div class="page-title"> 
            <h3 class="title">Bienvenido al Sistema de Turoría</h3> 
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="portlet">
                    <div class="portlet-heading bg-info">
                        <h3 class="portlet-title">
                            Comunicados
                        </h3>
                        <div class="portlet-widgets">
                            <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div id="portlet-2" class="panel-collapse collapse in">
                        <div class="portlet-body">

                        @foreach ($comunicados as $comunicado)    
                            <div class="alert alert-info alert-dismissible" role="alert" style="font-size: 16px;">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <strong>{{$comunicado->asunto}}: </strong><br>
                                {!! $comunicado->mensaje !!}
                            </div>
                        @endforeach 

                        @if(Auth::user()->type == 'teacher')
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12" id="sesindi17s">
                                    <strong>Archivos para el desarrollo de la Tutoría: </strong> <br> <br>

                                    <p><i class="fa fa-file-word-o" aria-hidden="true" style="color: blue;"></i> {{ link_to_asset('pdfs/dsGRUPAL.doc', 'SESIÓN DE TUTORÍA GRUPAL') }}</p> <br>
                                    <p><i class="fa fa-file-pdf-o" aria-hidden="true" style="color: red;"></i> {{ link_to_asset('pdfs/fREFERENCIAyCON.pdf', 'FICHA DE REFERENCIA Y CONTRA REFERENCIA') }}</p>
                                    <p><i class="fa fa-file-pdf-o" aria-hidden="true" style="color: red;"></i> {{ link_to_asset('pdfs/fSEGUIMIENTO.pdf', 'FICHA DE SEGUIMIENTO INDIVIDUAL') }}</p>
                                    <p><i class="fa fa-file-pdf-o" aria-hidden="true" style="color: red;"></i> {{ link_to_asset('pdfs/INFORME_FIN.pdf', 'INFORME DE FIN DE SEMESTRE DEL SISTEMA DE TUTORÍA Y ACOMPAÑAMIENTO UNIVERSITARIO') }}</p>
                                    <p><i class="fa fa-file-pdf-o" aria-hidden="true" style="color: red;"></i> {{ link_to_asset('pdfs/LISTA_COTEJO.pdf', 'LISTA DE COTEJO') }}</p>
                                    <p><i class="fa fa-file-pdf-o" aria-hidden="true" style="color: red;"></i> {{ link_to_asset('pdfs/MATRIZ_PLAN_TUTOR.pdf', 'MATRIZ DE COMPETENCIAS SOCIOEMOCIONALES I - IV SEMESTRE') }}</p>
                                    <p><i class="fa fa-file-pdf-o" aria-hidden="true" style="color: red;"></i> {{ link_to_asset('pdfs/MODELO_Ses_1.pdf', 'MODELO SESIÓN 1 DE TUTORÍA GRUPAL') }}</p>
                                    <p><i class="fa fa-file-pdf-o" aria-hidden="true" style="color: red;"></i> {{ link_to_asset('pdfs/MODELO_Ses_2.pdf', 'MODELO SESIÓN 2 DE TUTORÍA GRUPAL') }}</p>
                                    <p><i class="fa fa-file-pdf-o" aria-hidden="true" style="color: red;"></i> {{ link_to_asset('pdfs/PLAN_TUTORIA.pdf', 'PLAN DE TUTORÍA Y ACOMPAÑAMIENTO UNIVERSITARIO') }}</p>
                                    <p><i class="fa fa-file-pdf-o" aria-hidden="true" style="color: red;"></i> {{ link_to_asset('pdfs/TUTORIA_INDIVIDUAL.pdf', 'SESIÓN DE TUTORÍA INDIVIDUAL') }}</p>                                    
                                </div>
                            </div>
                        @endif

                        @if(Auth::user()->type == 'student')

                        @endif

                        </div>
                    </div>
                </div> 
            </div> 
        </div> 
  
@endsection