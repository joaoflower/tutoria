@extends('layouts.app')
@section('title', 'Agregar Coordinador de tutoría')

@section('aside')
	@include('layouts.include.aside')
@endsection

@section('content')
	{!! Form::open(['route' => 'usutut.store', 'method' => 'POST', 'class' => 'form-horizontal']) !!}

		<div class="form-group">
			{!! Form::label('cod_car', 'Escuela :', ['class' => 'col-md-2 control-label']) !!}
			<div class="col-md-9">
				{!! Form::select('cod_car', $carreras, null, ['class' => 'form-control select-carrera', 'required', 'data-placeholder' => 'Seleciones Carrera']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('codigo', 'Docente :', ['class' => 'col-md-2 control-label']) !!}
			<div class="col-md-9">
				{!! Form::select('codigo', [], null, ['class' => 'form-control select-docente', 'required', 'data-placeholder' => 'Seleciones Docente']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('email', 'E-mail :', ['class' => 'col-md-2 control-label']) !!}
			<div class="col-md-9">
				{!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'user@mail.com', 'required']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('username', 'Usuario :', ['class' => 'col-md-2 control-label']) !!}
			<div class="col-md-9">
				{!! Form::text('username', null, ['class' => 'form-control', 'placeholder' => 'Usuario', 'required']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('password', 'Contraseña :', ['class' => 'col-md-2 control-label']) !!}
			<div class="col-md-9">
				{!! Form::password('password', ['class' => 'form-control', 'placeholder' => '**********', 'required']) !!}
			</div>
		</div>

		<div class="form-group">
			<div class="col-md-6 col-md-offset-4">
				{!! Form::button('<span class="glyphicon glyphicon-floppy-save"></span> Agregar Coordinador', ['type' => 'submit', 'class' => 'btn btn-success']) !!}	
				<a href="{{ route('usutut.index') }}" class="btn btn-danger">
					<span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Cancelar
				</a>
			</div>
		</div>
	{!! Form::close() !!}
@endsection
@section('js')
	<script type="text/javascript">
		$('.select-carrera').chosen({
			allow_single_deselect: true
		});
		$('.select-docente').chosen({
			allow_single_deselect: true
		});

		$('#cod_car').change(event => {
			$.get(`${event.target.value}/docentes`, function(response, state) {
				$('#codigo').empty();
				response.forEach(element => {
					$('#codigo').append(`<option value=${element.cod_prf}>${element.paterno} ${element.materno} ${element.nombres} </option> `);
				});
				$('#codigo').trigger("chosen:updated");
			});
		});
	</script>
@endsection
