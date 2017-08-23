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
            <li class="has-submenu"><a href="#"><i class="ion-ios-people"></i> <span class="nav-label">Coordinadores</span></a>
                <ul class="list-unstyled">
                    <li><a href="{{ route('usutut.index') }}"><i class="ion-compose"></i> Ver Coordinadores</a></li>
                </ul>
            </li>            
            @endif

            @if(Auth::user()->type == 'head')
            <li class="has-submenu"><a href="#"><i class="ion-university"></i> <span class="nav-label">Tutoría</span></a>
                <ul class="list-unstyled">
                    <li><a href="{{ route('plan.index')  }}"><i class="ion-document-text"></i> Plan de Tutoría</a></li>
                    <li><a href="{{ route('grupo.create') }}"><i class="ion-person-add"></i> Nuevo Tutor</a></li>
                    <li><a href="{{ route('grupo.index') }}"><i class="ion-grid"></i> Lista de Tutores</a></li>
                </ul>
            </li>
            @endif

            @if(Auth::user()->type == 'teacher')
            <li><a href="{{ route('estugrupo.index') }}"><i class="ion-ios-people"></i> <span class="nav-label">Tutorados</span></a></li>
            <li class="has-submenu"><a href="#"><i class="ion-university"></i> <span class="nav-label">Reportes de Tutoría</span></a>
                <ul class="list-unstyled">
                    <li><a href="{{ route('sesindi17.index') }}"><i class="ion-compose"></i> Sesión de Tutoria Individual</a></li>
                    <li><a href="{{ route('sesgru.index') }}"><i class="ion-compose"></i> Tutoria grupal por sessión</a></li>
                    <li><a href="{{ route('seguimiento.index')  }}"><i class="ion-document-text"></i> Seguimiento Individual</a></li>
                </ul>
            </li>
            @endif

            @if(Auth::user()->type == 'student')
            <li class="has-submenu"><a href="#"><i class="ion-ios-people"></i> <span class="nav-label">Tutor</span></a>
                <ul class="list-unstyled">
                    <li><a href="{{ route('docgrupo.index') }}"><i class="ion-compose"></i> Ver tutor</a></li>
                </ul>
            </li>
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
        </ul>
    </nav>