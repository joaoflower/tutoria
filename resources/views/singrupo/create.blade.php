@extends('layouts.app')
@section('title', '[2017-I] Nueva sesión de Tutoria individual a estudiantes SIN Tutor')

@section('aside')
	@include('layouts.include.aside')
@endsection

@section('content')
	{!! Form::open(['route' => 'singrupo.store', 'method' => 'POST', 'class' => 'form-horizontal']) !!}

		<div class="form-group">
			{!! Form::label('tutor', 'Tutor :', ['class' => 'col-md-2 control-label']) !!}
			<div class="col-md-9">
				<p class="form-control-static">{{ $docente }}</p>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('num_mat', 'Tutorado', ['class' => 'col-md-2 control-label']) !!}
			<div class="col-md-9">
				{!! Form::select('num_mat', $estudiantes, null, ['class' => 'form-control select-estudiante', 'required', 'data-placeholder' => 'Seleciones Turorado']) !!}
			</div>
		</div>

		<div class="form-group">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				<p class="form-control-static"><strong>ESTIMADO DOCENTE: </strong> La sesión se inicia con la pregunta, ¿Cómo te está yendo en la universidad?, ¿Qué problemas tienes? </p>
				<p>De este diálogo inicial, repreguntar, ¿qué problema te afecta más?:</p>
			</div>
		</div>
<!--
		@foreach ($areaproblemas as $areaproblema)
		<div class="form-group">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				<table class="table table-striped table-bordered table-hover ">
					<thead>
						<tr class="success">
							<th><strong>{{ $areaproblema->name }}</strong> - Problemas identificados por el estudiante</th>
							<th width="80">Marque</th>
						</tr>
					</thead>
					<tbody>
					@foreach ($areaproblema->itemproblemas as $itemproblema)
						<tr>
							<td>{{ $itemproblema->name }}</td>
							<td>
								{!! Form::checkbox('sesindi17_pro['.$itemproblema->id.']') !!}	
							</td>
						</tr>
					@endforeach
					</tbody>
				</table>
			</div>
		</div>
		@endforeach

		<div class="form-group">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				<table class="table table-striped table-bordered table-hover ">
					<thead>
						<tr class="success">
							<th>El estudiante requiere ser referido a:</th>
							<th width="80">Marque</th>
						</tr>
					</thead>
					<tbody>
					@foreach ($itemreferidos as $itemreferido)
						<tr>
							<td>{{ $itemreferido->name }}</td>
							<td>
								{!! Form::checkbox('sesindi17_ref['.$itemreferido->id.']') !!}	
							</td>
						</tr>
					@endforeach
					</tbody>
				</table>
			</div>
		</div>
	-->	
		<div class="form-group">
			{!! Form::label('pro_ide', 'Problemática identificada :', ['class' => 'col-md-2 control-label']) !!}
			<div class="col-md-9">
				{!! Form::textarea('pro_ide', null, ['class' => 'form-control area-content', 'placeholder' => 'Ingrese la problemática identificada en la sesión', 'required', 'size' => '50x3']) !!}
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
				<a href="{{ route('index') }}" class="btn btn-danger">
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
