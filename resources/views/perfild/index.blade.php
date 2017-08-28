@extends('layouts.app17')

@section('title','Perfil')

@section('content')

        <div class="row">

            <div class="col-sm-12">
                <div class="bg-picture" style="background-image:url('images/single.jpg')">
                    <span class="bg-picture-overlay"></span><!-- overlay -->
                    <!-- meta -->
                    <div class="box-layout meta bottom">
                        <div class="col-sm-6 clearfix">
                            <span class="img-wrapper pull-left m-r-15"><img src="images/avatar.png" alt="" style="width:64px" class="br-radius"></span>
                            <div class="media-body">
                                <h3 class="text-white mb-2 m-t-10 ellipsis">{{ ucwords(strtolower($tutor->nombres)) }}</h3>
                                <h5 class="text-white">Docente tutor</h5>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="pull-right">
                                
                                <div class="dropdown">
                                    <a data-toggle="dropdown" class="dropdown-toggle btn btn-primary" href="#"> Tutor <span class="caret"></span></a>
                                    <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                    @if(Auth::user()->type == 'teacher')
                                        <li><a href="{{ route('perfild.edit', $tutor->cod_prf) }}">Modificar perfil</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#">Unfollow</a></li>
                                    @endif
                                    @if(Auth::user()->type == 'student')
                                        <li><a href="#">Enviar mensaje privado</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#">Unfollow</a></li>                                        
                                    @endif
                                    </ul>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <!--/ meta -->
                </div>
            </div>
        </div> 

        <div class="row m-t-15">
            <div class="col-sm-12">
                <div class="panel panel-default p-0">
                    <div class="panel-body p-0"> 
                        <ul class="nav nav-tabs profile-tabs">
                            <li class="active"><a data-toggle="tab" href="#aboutme">Acerca de</a></li>
                            <li class=""><a data-toggle="tab" href="#academico">Académico</a></li>
                        </ul>

                        <div class="tab-content m-0"> 

                            <div id="aboutme" class="tab-pane active">
                                <div class="profile-desk">
                                    <h1>{{$tutor->nombres.' '.$tutor->paterno.' '.$tutor->materno}}</h1>
                                    <span class="designation">{{$carrera->car_des}}</span>
                                    <p>                                        
                                        <strong>Los aspecto que puedo ayudar en la vida universitaria de un estudiante son: </strong> {{strip_tags($tutor->ayu_tutoria)}}
                                    </p>
                                    <table class="table table-condensed">
                                        <thead>
                                            <tr>
                                                <th colspan="2"><h3>Información de Contacto</h3></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><b>Celular</b></td>
                                                <td class="ng-binding">{{$tutor->celular}}</td>
                                            </tr>
                                            <tr>
                                                <td><b>Correo eletrónico</b></td>
                                                <td class="ng-binding">{{$tutor->email}}</td>
                                            </tr>
                                            <tr>
                                                <td><b>Facebook</b></td>
                                                <td><a href="{{$tutor->facebook}}" target="_blank" class="ng-binding">
                                                    {{$tutor->facebook}}
                                                </a></td>
                                            </tr>
                                            <tr>
                                                <td><b>Twitter</b></td>
                                                <td><a href="https://twitter.com/{{$tutor->twitter}}?lang=es" target="_blank" class="ng-binding">
                                                    {{$tutor->twitter}}
                                                </a></td>
                                            </tr>     
                                            <tr>
                                                <td><b>LinkedIn</b></td>
                                                <td><a href="{{$tutor->linkedin}}" target="_blank" class="ng-binding">
                                                    {{$tutor->linkedin}}
                                                </a></td>
                                            </tr>                                      
                                        </tbody>
                                    </table>
                                </div> <!-- end profile-desk -->
                            </div> <!-- about-me -->

                            <div id="academico" class="tab-pane">
                                <div class="row m-t-10">
                                    <div class="col-md-12">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
  
@endsection
@section('js')

@endsection