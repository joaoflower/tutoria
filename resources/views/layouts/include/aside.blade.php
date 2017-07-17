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
					<div class="link"><i class="fa fa-file-text"></i> Formatos <i class="fa fa-chevron-down"></i></div>
					<ul class="submenu">						
						<li><a href="{{ route('sesindi17.index') }}"><i class="fa fa-user"></i>  Sesión de Tutoria Individual</a></li>
						<li><a href="{{ route('sesgru.index') }}"><i class="fa fa-group"></i>  Tutoria grupal por sessión</a></li>
					</ul>
				</li>
			@endif

			@if(Auth::user()->type == 'student')
				<li>
					<div class="link"><i class="fa fa-user"></i> Tutores <i class="fa fa-chevron-down"></i></div>
					<ul class="submenu">
						<li><a href="{{ route('docgrupo.index') }}"><i class="fa fa-user"></i> Ver Tutores</a></li>
					</ul>
				</li>
				<li>
					<div class="link"><i class="fa fa-file-text"></i> Formatos <i class="fa fa-chevron-down"></i></div>
					<ul class="submenu">
						<li><a href="{{ route('itaestu.index') }}"><i class="fa fa-file-archive-o"></i>  Inf. Tec. Acad. del Tutorado</a></li>						
						<li><a href="{{ route('evalestu.index') }}"><i class="fa fa-check-circle-o"></i>  Evaluación del Estudiante</a></li>
					</ul>
				</li>
			@endif

			</ul>