@extends('layouts.app')
@section('title', '[2017-I] Encuesta de Satisfacción')

@section('aside')
	@include('layouts.include.aside')
@endsection

@section('content')
	{!! Form::open(['route' => 'encusati.store', 'method' => 'POST', 'class' => 'form-horizontal']) !!}

		<div class="form-group">
			{!! Form::label('tutor', 'Tutor :', ['class' => 'col-md-2 control-label']) !!}
			<div class="col-md-9">
				<p class="form-control-static">{{ $docente }}</p>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('estudiante', 'Estudiante :', ['class' => 'col-md-2 control-label']) !!}
			<div class="col-md-9">
				<p class="form-control-static">{{ $estudiante }}</p>
			</div>
		</div>

		<div class="form-group">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				<p class="form-control-static"><strong>ESTIMADO ESTUDIANTE: </strong> Responde con sinceridad las siguientes preguntas marcando la opción que mejor exprese tu opinión:</p>
			</div>
		</div>

		@foreach ($areaspectos as $areaspecto)
		<div class="form-group">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				<table class="table table-striped table-bordered table-hover ">
					<thead>
						<tr class="success">
							<th><strong>{{ $areaspecto->name }}</strong></th>
							<th width="150">Marque</th>
						</tr>
					</thead>
					<tbody>
					@foreach ($areaspecto->itemaspectos as $itemaspecto)
						<tr>
							<td>{{ $itemaspecto->name }}</td>
							<td>
								{!! Form::select('encusati_aspecto['.$itemaspecto->id.']', $evalaspectos, null, ['class' => 'form-control', 'required']) !!}
							</td>
						</tr>
					@endforeach
					</tbody>
				</table>
			</div>
		</div>
		@endforeach

		<div class="form-group">
			{!! Form::label('com_sug', 'Comentarios y Sugerencias :', ['class' => 'col-md-2 control-label']) !!}
			<div class="col-md-9">
				{!! Form::textarea('com_sug', null, ['class' => 'form-control area-content', 'placeholder' => 'Ingrese los comentarios y sugerencias', 'required', 'size' => '50x3']) !!}
			</div>
		</div>
		
		<div class="form-group">
			<div class="col-md-6 col-md-offset-4">
				{!! Form::button('<span class="glyphicon glyphicon-floppy-save"></span> Generar Constancia', ['type' => 'submit', 'class' => 'btn btn-success']) !!}	
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
