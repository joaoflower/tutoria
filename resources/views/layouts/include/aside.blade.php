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
						<li><a href="{{ route('induccion.index') }}"><i class="fa fa-share-alt"></i>  Inducción al Estudiante</a></li>
						<li><a href="{{ route('sesindi.index') }}"><i class="fa fa-user"></i>  Tutoria individual por sessión</a></li>
						<li><a href="{{ route('sesgru.index') }}"><i class="fa fa-group"></i>  Tutoria grupal por sessión</a></li>
						<li><a href="{{ route('itadoc.index') }}"><i class="fa fa-file-word-o"></i>  Inf. Tec. Acad. del Tutor</a></li>						
						<li><a href="{{ route('evaldoc.index') }}"><i class="fa fa-check-square-o"></i>  Evaluación del docente</a></li>
						<li><a href="#"><i class="fa fa-newspaper-o"></i>  Inf. de Resultados</a></li>
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