		<div class="form-group">
			{!! Form::label('c1', 'Apellidos y nombres :', ['class' => 'col-md-4 control-label']) !!}
			<div class="col-md-8">
				<p class="form-control-static"> {{$estudiante->paterno}} {{$estudiante->materno}}, {{$estudiante->nombres}} </p>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('c2', 'Escuela Profesional :', ['class' => 'col-md-4 control-label']) !!}
			<div class="col-md-8">
				<p class="form-control-static"> {{$estudiante->car_des}}</p>
			</div>
		</div>		
		<div class="form-group">
			{!! Form::label('c3', 'Matriculado en :', ['class' => 'col-md-4 control-label']) !!}
			<div class="col-md-8">
			@if($estumat != null)
				<p class="form-control-static"> {{$estumat->niv_est}} semestre</p>
			@else
				<p class="form-control-static"> NO MATRICULADO </p>
			@endif
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('c4', 'Docente tutor :', ['class' => 'col-md-4 control-label']) !!}
			<div class="col-md-8">
			@if($docente != null)
				<p class="form-control-static"> {{$docente}}</p>
			@else
				@if($estumat != null)
					<p class="form-control-static"> 
						SIN TUTOR
						<a href="#" onclick="if(confirm('¿Estas seguro que quieres Asiganr tuto?')) {add_tutor();} return false;" class="btn btn-primary">
							<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Asignar tutor
						</a>
					</p>
				@else
					<p class="form-control-static"> SIN TUTOR </p>
				@endif
			@endif
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('c4', 'Sesión individual :', ['class' => 'col-md-4 control-label']) !!}
			<div class="col-md-8">
			@if($sesindi17 != null)
				<p class="form-control-static"> Realizado el {{$sesindi17->fecha}}</p>
			@else
				<p class="form-control-static"> SIN SESIÓN </p>
			@endif
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('c4', 'Constancia de tutoría :', ['class' => 'col-md-4 control-label']) !!}
			<div class="col-md-8">
			@if($encusati != null)
				<p class="form-control-static"> Nro {{$encusati->id}}-2017</p>
			@else
				<p class="form-control-static"> SIN CONSTANCIA </p>
			@endif
			</div>
		</div>

		

