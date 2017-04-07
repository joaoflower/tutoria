@extends('layouts.app')
@section('title', 'Agregar Informe técnico académico del tutor')

@section('aside')
	@include('layouts.include.aside')
@endsection

@section('content')
	{!! Form::open(['route' => 'itadoc.store', 'method' => 'POST', 'class' => 'form-horizontal']) !!}

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
			{!! Form::label('mesita_id', 'Meses :', ['class' => 'col-md-2 control-label']) !!}
			<div class="col-md-9">
				{!! Form::select('mesita_id', $mesitas, null, ['class' => 'form-control select-estudiante', 'required', 'data-placeholder' => 'Seleciones Turorado']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('fecha', 'Fecha :', ['class' => 'col-md-2 control-label']) !!}
			<div class="col-md-9">
				{!! Form::input('date','fecha', null, ['class' => 'form-control fechas', 'required', 'placeholder' => 'aaaa-mm-dd']) !!}
			</div>
		</div>

		<div class="form-group">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				<p class="form-control-static"><strong>Estimado Docente Tutor: </strong> A continuación te solicitamos responder algunas preguntas relacionadas al desenvolvimiento de los éstudiantes tutorados que Ud. tiene a su cargo, y que se ha percibido en estos dos últimos meses.</p>
			</div>
		</div>

		<div class="form-group">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				{!! Form::label('itadoc_dific', '1. ¿Qué dificultades ha presentado el estudiante tutorado en los 2 últimos meses? :', ['class' => ' control-label']) !!}
				<table class="table table-striped table-bordered table-hover ">
					<tbody>
						@foreach ($dificultads as $dificultad)
							<tr>
								<td>{{ $dificultad->name }}</td>
								<td>
									{!! Form::select('itadoc_dific['.$dificultad->id.']', ['SI' => 'SI', 'NO' => 'NO'], null, ['class' => 'form-control', 'required']) !!}
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-1"></div>			
			<div class="col-md-10">
				{!! Form::label('res_dif', '2. ¿Cree que el estudiante tutorado ha resuelto estas actividades por medio de la tutoría? :', ['class' => 'control-label']) !!}
				{!! Form::select('res_dif', ['SI' => 'SI', 'NO' => 'NO', 'PARCIALMENTE' => 'PARCIALMENTE'], null, ['class' => 'form-control select-estudiante', 'required', 'data-placeholder' => 'Seleciones Turorado']) !!}
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				{!! Form::label('itadoc_avaca', '3. ¿En el ámbito Académico qué avances se perciben? :', ['class' => 'control-label']) !!}
				<table class="table table-striped table-bordered table-hover ">
					<tbody>
						@foreach ($avanceacas as $avanceaca)
							<tr>
								<td>{{ $avanceaca->name }}</td>
								<td>
									{!! Form::select('itadoc_avaca['.$avanceaca->id.']', ['SI' => 'SI', 'NO' => 'NO', 'REGULAR' => 'REGULAR'], null, ['class' => 'form-control', 'required']) !!}
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				{!! Form::label('itadoc_avpes', '4. En el ámbito Personal y Social qué avances se perciben? :', ['class' => 'control-label']) !!}
				<table class="table table-striped table-bordered table-hover ">
					<tbody>
						@foreach ($avancepess as $avancepes)
							<tr>
								<td>{{ $avancepes->name }}</td>
								<td>
									{!! Form::select('itadoc_avpes['.$avancepes->id.']', ['SI' => 'SI', 'NO' => 'NO', 'REGULAR' => 'REGULAR'], null, ['class' => 'form-control', 'required']) !!}
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('rec_sug', 'Recomendaciones y Sugerencias :', ['class' => 'col-md-2 control-label']) !!}
			<div class="col-md-9">
				{!! Form::textarea('rec_sug', null, ['class' => 'form-control area-content', 'placeholder' => 'Recomendaciones y Sugerencias', 'required', 'size' => '50x3']) !!}
			</div>
		</div>
		

		<div class="form-group">
			<div class="col-md-6 col-md-offset-4">
				{!! Form::button('<span class="glyphicon glyphicon-floppy-save"></span> Agregar Informe', ['type' => 'submit', 'class' => 'btn btn-success']) !!}	
				<a href="{{ route('itadoc.index') }}" class="btn btn-danger">
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
