@extends('layouts.app')
@section('title', 'Agregar Tutoria individual por sessión')

@section('aside')
	@include('layouts.include.aside')
@endsection

@section('content')
	{!! Form::open(['route' => 'sesindi.store', 'method' => 'POST', 'class' => 'form-horizontal']) !!}

		<div class="form-group">
			{!! Form::label('tutor', 'Tutor :', ['class' => 'col-md-2 control-label']) !!}
			<div class="col-md-9">
				<p class="form-control-static">{{ $docente }}</p>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('estugrupo_id', 'Tutorado', ['class' => 'col-md-2 control-label']) !!}
			<div class="col-md-9">
				{!! Form::select('estugrupo_id', $estudiantes, null, ['class' => 'form-control select-estudiante', 'required', 'data-placeholder' => 'Seleciones Turorado']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('tem_aca', 'Temas Académicos', ['class' => 'col-md-2 control-label']) !!}
			<div class="col-md-9">
				{!! Form::textarea('tem_aca', null, ['class' => 'form-control area-content', 'placeholder' => 'Ingrese los temas que se trataron en la sesión', 'required', 'size' => '50x3']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('tem_per', 'Temas Personales :', ['class' => 'col-md-2 control-label']) !!}
			<div class="col-md-9">
				{!! Form::textarea('tem_per', null, ['class' => 'form-control area-content', 'placeholder' => 'Ingrese los temas que se trataron en la sesión', 'required', 'size' => '50x3']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('pro_aca', 'Problemas Académicos :', ['class' => 'col-md-2 control-label']) !!}
			<div class="col-md-9">
				{!! Form::textarea('pro_aca', null, ['class' => 'form-control area-content', 'placeholder' => 'Ingrese los problemas que se encontraron en la sesión', 'required', 'size' => '50x3']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('pro_per', 'Problemas Personales :', ['class' => 'col-md-2 control-label']) !!}
			<div class="col-md-9">
				{!! Form::textarea('pro_per', null, ['class' => 'form-control area-content', 'placeholder' => 'Ingrese los problemas que se encontraron en la sesión', 'required', 'size' => '50x3']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('acu_aca', 'Acuerdos Académicos :', ['class' => 'col-md-2 control-label']) !!}
			<div class="col-md-9">
				{!! Form::textarea('acu_aca', null, ['class' => 'form-control area-content', 'placeholder' => 'Ingrese los acuerdos resultantes de la sesión', 'required', 'size' => '50x3']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('acu_per', 'Acuerdos Personales :', ['class' => 'col-md-2 control-label']) !!}
			<div class="col-md-9">
				{!! Form::textarea('acu_per', null, ['class' => 'form-control area-content', 'placeholder' => 'Ingrese los acuerdos resultantes de la sesión', 'required', 'size' => '50x3']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('obs_aca', 'Observaciones Académicos :', ['class' => 'col-md-2 control-label']) !!}
			<div class="col-md-9">
				{!! Form::textarea('obs_aca', null, ['class' => 'form-control area-content', 'placeholder' => 'Ingrese las observacines sobre la dinámica del estudiante', 'required', 'size' => '50x3']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('obs_per', 'Observaciones Personales :', ['class' => 'col-md-2 control-label']) !!}
			<div class="col-md-9">
				{!! Form::textarea('obs_per', null, ['class' => 'form-control area-content', 'placeholder' => 'Ingrese las observacines sobre la dinámica del estudiante', 'required', 'size' => '50x3']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('evalses_id', 'Evaluación de sesión :', ['class' => 'col-md-2 control-label']) !!}
			<div class="col-md-9">
				{!! Form::select('evalses_id', $evalsess, null, ['class' => 'form-control select-estudiante', 'required', 'data-placeholder' => 'Seleciones Turorado']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('fecha', 'Fecha de sesión :', ['class' => 'col-md-2 control-label']) !!}
			<div class="col-md-9">
				{!! Form::input('date','fecha', null, ['class' => 'form-control fechas', 'required', 'placeholder' => 'aaaa-mm-dd']) !!}
			</div>
		</div>
		

		<div class="form-group">
			<div class="col-md-6 col-md-offset-4">
				{!! Form::button('<span class="glyphicon glyphicon-floppy-save"></span> Agregar sesión', ['type' => 'submit', 'class' => 'btn btn-success']) !!}	
				<a href="{{ route('sesindi.index') }}" class="btn btn-danger">
					<span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Cancelar
				</a>
			</div>
		</div>
	{!! Form::close() !!}
@endsection
@section('js')
	<script type="text/javascript">
		$('.select-estudiante').chosen({
			allow_single_deselect: true
		});
		$('.area-content').trumbowyg({
		    fullscreenable: false,
		    btns: [ ['formatting'], 'btnGrp-semantic', ['link'], 'btnGrp-justify', 'btnGrp-lists']	 ,
		    autogrow: true   
		});
	</script>
@endsection
