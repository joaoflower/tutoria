			<ul id="accordion" class="accordion">
				
			@if(Auth::user()->type == 'admin')
				<li>
					<div class="link"><i class="fa fa-group"></i> Coordinadores <i class="fa fa-chevron-down"></i></div>
					<ul class="submenu">
						<li><a href="{{ route('usutut.index') }}"><i class="fa fa-group"></i> Ver Coordinadores</a></li>
					</ul>
				</li>
				<li>
					<div class="link"><i class="fa fa-graduation-cap"></i> Tutoría <i class="fa fa-chevron-down"></i></div>
					<ul class="submenu">
						<li><a href="{{ route('grupo.getcar') }}"><i class="fa fa-list-alt"></i> Seleccionar Escuela</a></li>
						<li><a href="{{ route('grupo.index') }}"><i class="fa fa-list-alt"></i> Lista de Tutorías</a></li>
					</ul>
				</li>

			@endif

			@if(Auth::user()->type == 'head')
				<li>
					<div class="link"><i class="fa fa-graduation-cap"></i> Tutoría <i class="fa fa-chevron-down"></i></div>
					<ul class="submenu">
						<li><a href="{{ route('grupo.create') }}"><i class="fa fa-user-plus"></i> Nueva Tutoría</a></li>
						<li><a href="{{ route('grupo.index') }}"><i class="fa fa-list-alt"></i> Lista de Tutorías</a></li>
					</ul>
				</li>
			@endif

			@if(Auth::user()->type == 'teacher')
				<li>
					<div class="link"><i class="fa fa-group"></i> Tutorados <i class="fa fa-chevron-down"></i></div>
					<ul class="submenu">
						<li><a href="{{ route('estugrupo.index') }}"><i class="fa fa-group"></i> Ver tutorados</a></li>
					</ul>
				</li>
				<li>
					<div class="link"><i class="fa fa-file-text"></i> Reportes de Tutoría <i class="fa fa-chevron-down"></i></div>
					<ul class="submenu">						
						<li><a href="{{ route('sesindi17.index') }}"><i class="fa fa-user"></i>  Sesión de Tutoria Individual</a></li>
						<li><a href="{{ route('sesgru.index') }}"><i class="fa fa-group"></i>  Tutoria grupal por sessión</a></li>
					</ul>
				</li>
			@endif

			@if(Auth::user()->type == 'student')
				<li>
					<div class="link"><i class="fa fa-user"></i> Tutor <i class="fa fa-chevron-down"></i></div>
					<ul class="submenu">
						<li><a href="{{ route('docgrupo.index') }}"><i class="fa fa-user"></i> Ver Tutor</a></li>
					</ul>
				</li>
				<li>
					<div class="link"><i class="fa fa-file-text"></i> Reportes de Tutoría <i class="fa fa-chevron-down"></i></div>
					<ul class="submenu">
						<li><a href="{{ route('encusati.index') }}"><i class="fa fa-file-archive-o"></i> Constancia de Tutoría</a></li>						
					</ul>
				</li>
			@endif

			@if(Auth::user()->type == 'psico')
				<li>
					<div class="link"><i class="fa fa-file-text"></i> Reportes de Tutoría <i class="fa fa-chevron-down"></i></div>
					<ul class="submenu">						
						<li><a href="{{ route('sesuna.index') }}"><i class="fa fa-user"></i> Sesión de Tutoria Individual</a></li>
						<li><a href="{{ route('singrupo.index') }}"><i class="fa fa-user"></i> Estudiantes sin Tutor</a></li>
					</ul>
				</li>

			@endif

			</ul>