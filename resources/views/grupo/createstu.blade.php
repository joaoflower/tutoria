@extends('layouts.app')

@section('title','Agregar Estudiante de Tutoría')

@section('aside')
	@include('layouts.include.aside')
@endsection

@section('content')
	{!! Form::open(['route' => ['grupo.storestu', $grupo->id], 'method' => 'PUT', 'class' => 'form-horizontal']) !!}
		
		<div class="form-group">
			{!! Form::label('docente', 'Docente Tutor :', ['class' => 'col-md-2 control-label']) !!}
			<div class="col-md-9">
				<p class="form-control-static">{{ $grupo->nameDocente }}</p>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-12" style="text-align: center;">
				<p class="bg-warning">Seleccione un <b>Estudiante</b> para agregarlo como tutorando.</p>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('num_mat', 'Ingresante :', ['class' => 'col-md-2 control-label']) !!}
			<div class="col-md-9">
				{!! Form::select('num_mat', $estudiantes, null, ['class' => 'form-control select-estudiante', 'required', 'data-placeholder' => 'Seleciones Carrera']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('num_matRe', 'Regular :', ['class' => 'col-md-2 control-label']) !!}
			<div class="col-md-9">
				{!! Form::select('num_matRe', $regulares, null, ['class' => 'form-control select-estudiante', 'required', 'data-placeholder' => 'Seleciones Carrera']) !!}
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-12">
				<table class="table table-striped table-bordered table-hover ">
					<thead>
						<tr>
							<th>Num. Mat.</th>
							<th>Estudiante</th>
							<th>Escuela</th>
							<th>Acción</th>
						</tr>
					</thead>
					<tbody id="tutorados">
						@include('grupo.tutorados')
					</tbody>
				</table>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-6 col-md-offset-4">
				<a href="{{ route('grupo.index') }}" class="btn btn-danger">
					<span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Cerrar
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

		$('#num_mat').change(event => {
			$.get(`${event.target.value}/tutorado`, function(response, state) {
				$('#tutorados').html(response);
			});
		});
		$('#num_matRe').change(event => {
			$.get(`${event.target.value}/tutorado`, function(response, state) {
				$('#tutorados').html(response);
			});
		});
		function delEstudiante(id) {
			$.get(`${id}/deltutorado`, function(response, state) {
				$('#tutorados').html(response);
			});
		}

	</script>
@endsection
