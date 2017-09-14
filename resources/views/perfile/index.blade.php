@extends('layouts.app17')

@section('title','Perfil')

@section('content')

        <div class="row">

            <div class="col-sm-12">
                <div class="bg-picture" style="background-image:url('/images/single.jpg')">
                    <span class="bg-picture-overlay"></span><!-- overlay -->
                    <!-- meta -->
                    <div class="box-layout meta bottom">
                        <div class="col-sm-6 clearfix">
                            <span class="img-wrapper pull-left m-r-15"><img src="/images/avatar.png" alt="" style="width:64px" class="br-radius"></span>
                            <div class="media-body">
                                <h3 class="text-white mb-2 m-t-10 ellipsis">{{ ucwords(strtolower($tutorado->nombres)) }}</h3>
                                <h5 class="text-white">Tutorado</h5>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="pull-right">
                                
                                <div class="dropdown">
                                    <a data-toggle="dropdown" class="dropdown-toggle btn btn-primary" href="#"> Tutorado <span class="caret"></span></a>
                                    <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                    @if(Auth::user()->type == 'teacher')
                                        <li><a href="#">Enviar mensaje privado</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#">Unfollow</a></li>
                                    @endif
                                    @if(Auth::user()->type == 'student')
                                        <li><a href="{{ route('perfile.edit', $tutorado->num_mat) }}">Modificar perfil</a></li>
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
                            <li class=""><a data-toggle="tab" href="#informacion">Más información</a></li>
                            <li class=""><a data-toggle="tab" href="#habito-hobby">Hábitos y hobbies</a></li>
                            <li class=""><a data-toggle="tab" href="#academico">Académico</a></li>
                        </ul>

                        <div class="tab-content m-0"> 

                            <div id="aboutme" class="tab-pane active">
                                <div class="profile-desk">
                                    <h1>{{$tutorado->nombres.' '.$tutorado->paterno.' '.$tutorado->materno}}</h1>
                                    <span class="designation">{{$carrera->car_des}}</span>
                                    <p>                                        
                                        <strong>La tutoría me puede ayudar en los siguientes aspectos: </strong> <br>
                                        {!! $tutorado->ayu_tutoria !!}
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
                                                <td class="ng-binding">{{$tutorado->celular}}</td>
                                            </tr>
                                            <tr>
                                                <td><b>Correo eletrónico</b></td>
                                                <td class="ng-binding">{{$tutorado->email}}</td>
                                            </tr>
                                            <tr>
                                                <td><b>Facebook</b></td>
                                                <td><a href="{{$tutorado->facebook}}" target="_blank" class="ng-binding">
                                                    {{$tutorado->facebook}}
                                                </a></td>
                                            </tr>
                                            <tr>
                                                <td><b>Twitter</b></td>
                                                <td><a href="https://twitter.com/{{$tutorado->twitter}}?lang=es" target="_blank" class="ng-binding">
                                                    {{$tutorado->twitter}}
                                                </a></td>
                                            </tr>     
                                            <tr>
                                                <td><b>LinkedIn</b></td>
                                                <td><a href="{{$tutorado->linkedin}}" target="_blank" class="ng-binding">
                                                    {{$tutorado->linkedin}}
                                                </a></td>
                                            </tr>           
                                        </tbody>
                                    </table>
                                </div> <!-- end profile-desk -->
                            </div> <!-- about-me -->

                            <!-- Information -->
                            <div id="informacion" class="tab-pane">
                                <div class="profile-desk">
                                    <table class="table table-condensed">
                                        <thead>
                                            <tr>
                                                <th colspan="3"><h3>Información académica</h3></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><b>Semestre</b></td>
                                                <td class="ng-binding">{{$estumat->niv_est}} semestre</td>
                                            </tr>
                                            <tr>
                                                <td><b>Situación académica</b></td>
                                                <td class="ng-binding">{{$tutorado->situ_aca}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table class="table table-condensed">
                                        <thead>
                                            <tr>
                                                <th colspan="3"><h3>Información personal</h3></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><b>¿Presenta Discapacidad?</b></td>
                                                <td class="ng-binding">{{$tutorado->disca_if.' - '.$tutorado->disca_des}} </td>
                                            </tr>
                                            <tr>
                                                <td><b>¿Presenta Enfermedad crónica?</b></td>
                                                <td class="ng-binding">{{$tutorado->enfer_if.' - '.$tutorado->enfer_des}} </td>
                                            </tr>
                                            <tr>
                                                <td><b>¿Tiene buena salud?</b></td>
                                                <td class="ng-binding">{{$tutorado->salud_if.' - '.$tutorado->salud_des}} </td>
                                            </tr>
                                            <tr>
                                                <td><b>¿Con quien vive?</b></td>
                                                <td class="ng-binding">{{$tutorado->con_vive.' y depende económicamente de '.$tutorado->depe_eco}} </td>
                                            </tr>
                                            <tr>
                                                <td><b>Procedencia</b></td>
                                                <td class="ng-binding">{{$tutorado->pro_dep.' - '.$tutorado->pro_pro.' - '.$tutorado->pro_dis.' - '.$tutorado->pro_dep.' - '.$tutorado->com_par}} </td>
                                            </tr>
                                            <tr>
                                                <td><b>Residencia</b></td>
                                                <td class="ng-binding">{{$tutorado->resi_dir.' ('.$tutorado->resi_ref.')'}} <b>Tipo: </b>{{$tutorado->resi_tipo}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div> <!-- end profile-desk -->
                            </div>

                            <!-- settings -->
                            <div id="habito-hobby" class="tab-pane">
                                 <div class="profile-desk">
                                    <table class="table table-condensed">
                                        <thead>
                                            <tr>
                                                <th><h3>Hábitos de estudio</h3></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($itemhabitos as $itemhabito)
                                            <tr>
                                                <td class="ng-binding">{{$itemhabito->name}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <table class="table table-condensed">
                                        <thead>
                                            <tr>
                                                <th><h3>Principales pasatiempos, hobbies y otros</h3></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($itemhobbies as $itemhobby)
                                            <tr>
                                                <td class="ng-binding">{{$itemhobby->name}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

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