        <button type="button" class="navbar-toggle pull-left">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        
        <!-- navbar -->
        <nav class=" navbar-default" role="navigation">
        @if(Auth::user())
            <!-- Right navbar -->
            <ul class="nav navbar-nav navbar-right top-menu top-right-menu">  
                <!-- Foro de discución -->  
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <i class="fa fa-envelope-o "></i>
                        <span class="badge badge-sm up bg-purple count">4</span>
                    </a>
                    <ul class="dropdown-menu extended fadeInUp animated nicescroll" tabindex="5001">
                        <li>
                            <p>Foro de discución</p>
                        </li>
                        <li>
                            <a href="#">
                                <span class="pull-left"><img src="img/avatar-2.jpg" class="img-circle thumb-sm m-r-15" alt="img"></span>
                                <span class="block"><strong>Juan Perez</strong></span>
                                <span class="media-body block">Nuevo tema de discución<br><small class="text-muted">Hace 10 segundos</small></span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="pull-left"><img src="img/avatar-3.jpg" class="img-circle thumb-sm m-r-15" alt="img"></span>
                                <span class="block"><strong>Maria Quispe</strong></span>
                                <span class="media-body block">Nuevo tema de discución<br><small class="text-muted">Hace 3 minutos</small></span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="pull-left"><img src="img/avatar-4.jpg" class="img-circle thumb-sm m-r-15" alt="img"></span>
                                <span class="block"><strong>Rosa Rivera</strong></span>
                                <span class="media-body block">Nuevo tema de discución<br><small class="text-muted">Hace 10 minutes</small></span>
                            </a>
                        </li>
                        <li>
                            <p><a href="#" class="text-right">Ver el foro d discución</a></p>
                        </li>
                    </ul>
                </li>
                <!-- End: foro de discución -->
                <!-- Comunicados -->
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <i class="fa fa-bell-o"></i>
                        <span class="badge badge-sm up bg-pink count">@if( isset($comunicados) ) {{$comunicados->count()}} @else 0 @endif</span>
                    </a>
                    <ul class="dropdown-menu extended fadeInUp animated nicescroll" tabindex="5002">
                        <li class="noti-header">
                            <p>Comunicados</p>
                        </li>
                        @if(isset($comunicados))
                        @foreach ($comunicados as $comunicado) 
                        <li>
                            <a href="#">
                                <span class="pull-left"><i class="fa fa-bell-o fa-2x text-info"></i></span>
                                <span>{{$comunicado->asunto}}<br><small class="text-muted">Hace un momento</small></span>
                            </a>
                        </li>
                        @endforeach
                        @endif
                        <li>
                            <p><a href="{{ route('index') }}" class="text-right">Ver todos los comunicados</a></p>
                        </li>
                    </ul>
                </li>
                <!-- End: Comunicados -->

                <!-- user login dropdown start-->
                <li class="dropdown text-center">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <img alt="" src="img/avatar-2.jpg" class="img-circle profile-img thumb-sm">
                        <span class="username">{{ ucwords(strtolower(Auth::user()->name)) }} </span> <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu pro-menu fadeInUp animated" tabindex="5003" style="overflow: hidden; outline: none;">
                    @if(Auth::user()->type == 'teacher')
                        <li><a href="{{ route('perfild.index') }}"><i class="fa fa-briefcase"></i> Perfil</a></li>
                    @endif
                    @if(Auth::user()->type == 'student')
                        <li><a href="{{ route('perfile.index') }}"><i class="fa fa-briefcase"></i> Perfil</a></li>
                    @endif
                        <!--<li><a href="profile.html"><i class="fa fa-briefcase"></i> Perfil</a></li>
                        <li><a href="#"><i class="fa fa-cog"></i> Configuración</a></li>
                        <li><a href="#"><i class="fa fa-users"></i> Tutorandos <span class="label label-info pull-right mail-info">5</span></a></li>-->
                        <li><a href="{{ route('auth.logout') }}"><i class="fa fa-sign-out"></i> Salir</a></li>
                    </ul>
                </li>
                <!-- End: user login dropdown end -->       
            </ul>
        @endif
            <!-- End: right navbar -->
        </nav> 