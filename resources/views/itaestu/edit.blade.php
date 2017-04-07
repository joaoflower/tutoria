@extends('layouts.app')
@section('title', 'Editar Informe técnico académico del tutorando')

@section('aside')
	@include('layouts.include.aside')
@endsection

@section('content')
	{!! Form::open(['route' => ['itaestu.update', $itaestu], 'method' => 'PUT', 'class' => 'form-horizontal']) !!}

		<div class="form-group">
			{!! Form::label('tutor', 'Tutor :', ['class' => 'col-md-2 control-label']) !!}
			<div class="col-md-9">
				<p class="form-control-static">{{ $docente }}</p>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('tutorado', 'Tutorado :', ['class' => 'col-md-2 control-label']) !!}
			<div class="col-md-9">
				<p class="form-control-static">{{ $estudiante }}</p>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('mesita_id', 'Meses :', ['class' => 'col-md-2 control-label']) !!}
			<div class="col-md-9">
				{!! Form::select('mesita_id', $mesitas, $itaestu->mesita_id, ['class' => 'form-control select-estudiante', 'required', 'data-placeholder' => 'Seleciones Turorado']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('fecha', 'Fecha :', ['class' => 'col-md-2 control-label']) !!}
			<div class="col-md-9">
				{!! Form::input('date','fecha', $itaestu->fecha, ['class' => 'form-control fechas', 'required', 'placeholder' => 'aaaa-mm-dd']) !!}
			</div>
		</div>

		<div class="form-group">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				<p class="form-control-static"><strong>Estimado estudiante tutorado: </strong> A continuación te solicitamos responder algunas preguntas relacionadas al proceso de tutoria en nuestra universidad.</p>
			</div>
		</div>

		<div class="form-group">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				{!! Form::label('itaestu_dific', '1. ¿Qué dificultades haz presentado en los 2 últimos meses? :', ['class' => ' control-label']) !!}
				<table class="table table-striped table-bordered table-hover ">
					<tbody>
						@foreach ($dificultads as $dificultad)
							<tr>
								<td>{{ $dificultad->name }}</td>
								<td>
									{!! Form::select('itaestu_dific['.$dificultad->id.']', ['SI' => 'SI', 'NO' => 'NO'], $itaestu_dific[$dificultad->id], ['class' => 'form-control', 'required']) !!}
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
				{!! Form::label('res_dif', '2.  ¿Las actividades de tutoría te ayudaron a resolver tus dificultades? :', ['class' => 'control-label']) !!}
				{!! Form::select('res_dif', ['SI' => 'SI', 'NO' => 'NO', 'PARCIALMENTE' => 'PARCIALMENTE'], $itaestu->res_dif, ['class' => 'form-control select-estudiante', 'required', 'data-placeholder' => 'Seleciones Turorado']) !!}
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				{!! Form::label('itaestu_avaca', '3. ¿En el ámbito Académico qué avances has tenido?', ['class' => 'control-label']) !!}
				<table class="table table-striped table-bordered table-hover ">
					<tbody>
						@foreach ($avanceacas as $avanceaca)
							<tr>
								<td>{{ $avanceaca->name }}</td>
								<td>
									{!! Form::select('itaestu_avaca['.$avanceaca->id.']', ['SI' => 'SI', 'NO' => 'NO', 'REGULAR' => 'REGULAR'], $itaestu_avaca[$avanceaca->id], ['class' => 'form-control', 'required']) !!}
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
				{!! Form::label('itaestu_avpes', '4. En el ámbito Personal y Social qué avances se perciben?:', ['class' => 'control-label']) !!}
				<table class="table table-striped table-bordered table-hover ">
					<tbody>
						@foreach ($avancepess as $avancepes)
							<tr>
								<td>{{ $avancepes->name }}</td>
								<td>
									{!! Form::select('itaestu_avpes['.$avancepes->id.']', ['SI' => 'SI', 'NO' => 'NO', 'REGULAR' => 'REGULAR'], $itaestu_avpes[$avancepes->id], ['class' => 'form-control', 'required']) !!}
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
				{!! Form::textarea('rec_sug', $itaestu->rec_sug, ['class' => 'form-control area-content', 'placeholder' => 'Recomendaciones y Sugenrencias', 'required', 'size' => '50x3']) !!}
			</div>
		</div>
		

		<div class="form-group">
			<div class="col-md-6 col-md-offset-4">
				{!! Form::button('<span class="glyphicon glyphicon-floppy-save"></span> Editar Informe', ['type' => 'submit', 'class' => 'btn btn-success']) !!}	
				<a href="{{ route('itaestu.index') }}" class="btn btn-danger">
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
