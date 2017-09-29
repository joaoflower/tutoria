	<div class="logo">
		<a href="#" class="logo-expanded">
			<i class="ion-university"></i>
			<span class="nav-label">Tutoría</span>
		</a>
	</div>		
    <nav class="navigation">
        <ul class="list-unstyled">
            <li class="active"><a href="{{ route('index') }}"><i class="ion-home"></i> <span class="nav-label">Inicio</span></a></li>
            
        @if(Auth::user()->type == 'admin')
            <li class="has-submenu"><a href="{{ route('usutut.index')  }}"><i class="ion-ios-people"></i> <span class="nav-label">Lista de Coordinadores</span><span class="badge bg-success">Nuevo</span></a></li>
            <li class="has-submenu"><a href="{{ route('estadistica.index') }}"><i class="ion-stats-bars"></i> <span class="nav-label">Estadísticas</span></a></li>
            <li class="has-submenu"><a href="{{ route('comunicado.index')  }}"><i class="ion-ios-bell-outline"></i> <span class="nav-label">Lista de Comunicados</span><span class="badge bg-success">Nuevo</span></a></li>            
        @endif

        @if(Auth::user()->type == 'head')
            <li><a href="{{ route('perfild.index') }}"><i class="ion-briefcase"></i> <span class="nav-label">Ver mi Perfil</span><span class="badge bg-success">Nuevo</span></a></li>
            <li class="has-submenu"><a href="{{ route('plan.index')  }}"><i class="ion-document-text"></i> <span class="nav-label">Ingreso del Plan de Tutoría</span><span class="badge bg-success">Nuevo</span></a></li>
            <li class="has-submenu"><a href="{{ route('grupo.index') }}"><i class="ion-person-add"></i> <span class="nav-label">Asignación de Tutores a Tutorados</span><span class="badge bg-success">Nuevo</span></a></li>
            <li class="has-submenu"><a href="{{ route('grupot.tutortutorado') }}"><i class="ion-person-add"></i> <span class="nav-label">Lista de Tutores y Tutorados</span><span class="badge bg-success">Nuevo</span></a></li>
            <li class="has-submenu"><a href="{{ route('estadistica.grupos', Auth::user()->cod_car) }}"><i class="ion-stats-bars"></i> <span class="nav-label">Estadísticas</span><span class="badge bg-success">Nuevo</span></a></li>
        @endif

        @if(Auth::user()->type == 'teacher')
            <li><a href="{{ route('perfild.index') }}"><i class="ion-briefcase"></i> <span class="nav-label">Ver mi Perfil</span><span class="badge bg-success">Nuevo</span></a></li>
            <li><a href="{{ route('estugrupo.index') }}"><i class="ion-ios-people"></i> <span class="nav-label">Lista de Tutorados</span></a></li>
            <li><a href="{{ route('sesindi17.index') }}"><i class="ion-compose"></i> <span class="nav-label">Sesión de Tutoria Individual</span><span class="badge bg-success">Nuevo</span></a></li>
            <li><a href="{{ route('seguimiento.index')  }}"><i class="ion-document-text"></i> <span class="nav-label">Seguimiento a tutorados referidos</span><span class="badge bg-success">Nuevo</span></a></li>
            <li><a href="{{ route('sesgru.index') }}"><i class="ion-compose"></i> <span class="nav-label">Tutoria grupal por sessión</span><span class="badge bg-success">Nuevo</span></a></li>
        @endif

        @if(Auth::user()->type == 'student')
            <li><a href="{{ route('perfile.index') }}"><i class="ion-briefcase"></i> <span class="nav-label">Ver mi Perfil</span><span class="badge bg-success">Nuevo</span></a></li>
            <li><a href="{{ route('docgrupo.index') }}"><i class="ion-person"></i> <span class="nav-label">Ver mi Tutor</span><span class="badge bg-success">Nuevo</span></a></li>
            <li class="has-submenu"><a href="#"><i class="ion-university"></i> <span class="nav-label">Reportes de Tutoría</span></a>
                <ul class="list-unstyled">
                    <li><a href="{{ route('encusati.index') }}"><i class="ion-compose"></i> Constancia de Tutoría</a></li>
                </ul>
            </li>
        @endif

        @if(Auth::user()->type == 'psico')
            <li class="has-submenu"><a href="#"><i class="ion-university"></i> <span class="nav-label">Reportes de Tutoría</span></a>
                <ul class="list-unstyled">
                    <li><a href="{{ route('sesuna.index') }}"><i class="ion-compose"></i> Sesión de Tutoria Individual</a></li>
                    <li><a href="{{ route('singrupo.index') }}"><i class="ion-compose"></i> Estudiantes sin Tutor</a></li>
                    <li><a href="{{ route('infoestu.index') }}"><i class="ion-compose"></i> Información de Estudiantes</a></li>
                </ul>
            </li>
        @endif

        @if(Auth::user()->type == 'oficina')
            <li class="has-submenu"><a href="{{ route('referido.index') }}"><i class="ion-ios-people"></i> <span class="nav-label">Lista de referidos</span></a></li>
            <li class="has-submenu"><a href="{{ route('atencionref.index') }}"><i class="ion-ios-people"></i> <span class="nav-label">Lista de atendidos</span></a></li>
        @endif
        @if(Auth::user()->type == 'vice' or Auth::user()->type == 'query')
            <li class="has-submenu"><a href="{{ route('estadistica.index') }}"><i class="ion-stats-bars"></i> <span class="nav-label">Estadísticas</span></a></li>
        @endif
            <li class="has-submenu"><a href="{{ route('auth.logout') }}"><i class="ion-log-out"></i> <span class="nav-label">Salir del Sistema</span></a></li>
        </ul>
    </nav>
