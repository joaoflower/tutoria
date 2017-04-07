@extends('layouts.app')
@section('title', 'Agregar Tutoria individual por sessión')

@section('aside')
	@include('layouts.include.aside')
@endsection

@section('content')
	{!! Form::open(['route' => ['sesindi.update', $sesindi], 'method' => 'PUT', 'class' => 'form-horizontal']) !!}

		<div class="form-group">
			{!! Form::label('tutor', 'Tutor :', ['class' => 'col-md-2 control-label']) !!}
			<div class="col-md-9">
				<p class="form-control-static">{{ $docente }}</p>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('estugrupo_id', 'Tutorado', ['class' => 'col-md-2 control-label']) !!}
			<div class="col-md-9">
				<p class="form-control-static">{{ $sesindi->name }}</p>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('tem_aca', 'Temas Académicos', ['class' => 'col-md-2 control-label']) !!}
			<div class="col-md-9">
				{!! Form::textarea('tem_aca', $sesindi->tem_aca , ['class' => 'form-control area-content', 'placeholder' => 'Ingrese los temas que se trataron en la sesión', 'required', 'size' => '50x3']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('tem_per', 'Temas Personales :', ['class' => 'col-md-2 control-label']) !!}
			<div class="col-md-9">
				{!! Form::textarea('tem_per',$sesindi->tem_per, ['class' => 'form-control area-content', 'placeholder' => 'Ingrese los temas que se trataron en la sesión', 'required', 'size' => '50x3']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('pro_aca', 'Problemas Académicos :', ['class' => 'col-md-2 control-label']) !!}
			<div class="col-md-9">
				{!! Form::textarea('pro_aca', $sesindi->pro_aca, ['class' => 'form-control area-content', 'placeholder' => 'Ingrese los problemas que se encontraron en la sesión', 'required', 'size' => '50x3']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('pro_per', 'Problemas Personales :', ['class' => 'col-md-2 control-label']) !!}
			<div class="col-md-9">
				{!! Form::textarea('pro_per', $sesindi->pro_per, ['class' => 'form-control area-content', 'placeholder' => 'Ingrese los problemas que se encontraron en la sesión', 'required', 'size' => '50x3']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('acu_aca', 'Acuerdos Académicos :', ['class' => 'col-md-2 control-label']) !!}
			<div class="col-md-9">
				{!! Form::textarea('acu_aca', $sesindi->acu_aca, ['class' => 'form-control area-content', 'placeholder' => 'Ingrese los acuerdos resultantes de la sesión', 'required', 'size' => '50x3']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('acu_per', 'Acuerdos Personales :', ['class' => 'col-md-2 control-label']) !!}
			<div class="col-md-9">
				{!! Form::textarea('acu_per', $sesindi->acu_per, ['class' => 'form-control area-content', 'placeholder' => 'Ingrese los acuerdos resultantes de la sesión', 'required', 'size' => '50x3']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('obs_aca', 'Observaciones Académicos :', ['class' => 'col-md-2 control-label']) !!}
			<div class="col-md-9">
				{!! Form::textarea('obs_aca', $sesindi->obs_aca, ['class' => 'form-control area-content', 'placeholder' => 'Ingrese las observacines sobre la dinámica del estudiante', 'required', 'size' => '50x3']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('obs_per', 'Observaciones Personales :', ['class' => 'col-md-2 control-label']) !!}
			<div class="col-md-9">
				{!! Form::textarea('obs_per', $sesindi->obs_per, ['class' => 'form-control area-content', 'placeholder' => 'Ingrese las observacines sobre la dinámica del estudiante', 'required', 'size' => '50x3']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('evalses_id', 'Evaluación de sesión :', ['class' => 'col-md-2 control-label']) !!}
			<div class="col-md-9">
				{!! Form::select('evalses_id', $evalsess, $sesindi->evalses_id, ['class' => 'form-control select-estudiante', 'required', 'data-placeholder' => 'Seleciones Turorado']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('fecha', 'Fecha de sesión :', ['class' => 'col-md-2 control-label']) !!}
			<div class="col-md-9">
				{!! Form::input('date','fecha', $sesindi->fecha, ['class' => 'form-control fechas', 'required', 'placeholder' => 'aaaa-mm-dd']) !!}
			</div>
		</div>
		

		<div class="form-group">
			<div class="col-md-6 col-md-offset-4">
				{!! Form::button('<span class="glyphicon glyphicon-floppy-save"></span> Editar sesión', ['type' => 'submit', 'class' => 'btn btn-success']) !!}	
				<a href="{{ route('sesindi.index') }}" class="btn btn-danger">
					<span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Cancelar
				</a>
			</div>
		</div>
	{!! Form::close() !!}
@endsection
@section('js')
	<script type="text/javascript">
		$('.area-content').trumbowyg({
		    fullscreenable: false,
		    btns: [ ['formatting'], 'btnGrp-semantic', ['link'], 'btnGrp-justify', 'btnGrp-lists']	 ,
		    autogrow: true   
		});
	</script>
@endsection
