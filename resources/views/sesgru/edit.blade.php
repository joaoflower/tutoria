@extends('layouts.app')
@section('title', 'Editar Tutoria grupal por sessión')

@section('aside')
	@include('layouts.include.aside')
@endsection

@section('content')
	{!! Form::open(['route' => ['sesgru.update', $sesgru], 'method' => 'PUT', 'class' => 'form-horizontal']) !!}

		<div class="form-group">
			{!! Form::label('name', 'Grupo :', ['class' => 'col-md-2 control-label']) !!}
			<div class="col-md-9">
				<p class="form-control-static">{{ $grupo->name }}</p>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('tutor', 'Tutor :', ['class' => 'col-md-2 control-label']) !!}
			<div class="col-md-9">
				<p class="form-control-static">{{ $docente }}</p>
			</div>
		</div>

		<div class="form-group">
			{!! Form::label('tutorados', 'Tutorados :', ['class' => 'col-md-2 control-label']) !!}
			<div class="col-md-9">
				<table class="table table-striped table-bordered table-hover ">
					<thead>
						<tr class="success">
							<th>Tutorados</th>
							<th>Asistencia</th>
							<th>Evaluación</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($estudiantes as $estugrupo_id => $name)
							<tr>
								<td>{{ $name }}</td>
								<td>
									{!! Form::select('asi_ests['.$estugrupo_id.']', ['ASISTIO' => 'Asistio', 'NO ASISTIO' => 'No asistio'], $asi_ests[$estugrupo_id], ['class' => 'form-control', 'required']) !!}
								</td>
								<td>
									{!! Form::select('evalses_ids['.$estugrupo_id.']', $evalsess, $evalses_ids[$estugrupo_id], ['class' => 'form-control', 'required']) !!}
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
		{!! Form::hidden('tem_ses', $sesgru->tem_ses) !!}
		{!! Form::hidden('pro_ses', $sesgru->pro_ses) !!}
		{!! Form::hidden('acu_ses', $sesgru->acu_ses) !!}
		{!! Form::hidden('obs_ses', $sesgru->obs_ses) !!}

		<!--
		<div class="form-group">
			{!! Form::label('tem_ses', 'Temas en la sesión :', ['class' => 'col-md-2 control-label']) !!}
			<div class="col-md-9">
				{!! Form::textarea('tem_ses', $sesgru->tem_ses, ['class' => 'form-control area-content', 'placeholder' => 'Ingrese los temas tratados en la sesión', 'required', 'size' => '50x3']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('pro_ses', 'Problemas y demandas :', ['class' => 'col-md-2 control-label']) !!}
			<div class="col-md-9">
				{!! Form::textarea('pro_ses', $sesgru->pro_ses, ['class' => 'form-control area-content', 'placeholder' => 'Ingrese los problemas y demandas detectadas en la sesión', 'required', 'size' => '50x3']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('acu_ses', 'Acuerdos y Soluciones :', ['class' => 'col-md-2 control-label']) !!}
			<div class="col-md-9">
				{!! Form::textarea('acu_ses', $sesgru->acu_ses, ['class' => 'form-control area-content', 'placeholder' => 'Ingrese los Acuerdos y soluciones resultantes de la sesión', 'required', 'size' => '50x3']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('obs_ses', 'Onservaciones del tutor :', ['class' => 'col-md-2 control-label']) !!}
			<div class="col-md-9">
				{!! Form::textarea('obs_ses', $sesgru->obs_ses, ['class' => 'form-control area-content', 'placeholder' => 'Ingrese las observaciones del tutor sobre la dinámica del grupo o algún(os) tutorando(s) en particular', 'required', 'size' => '50x3']) !!}
			</div>
		</div>
		-->
		
		<div class="form-group">
			{!! Form::label('evalses_id', 'Evaluación de sesión :', ['class' => 'col-md-2 control-label']) !!}
			<div class="col-md-9">
				{!! Form::select('evalses_id', $evalsess, $sesgru->evalses_id, ['class' => 'form-control select-estudiante', 'required', 'data-placeholder' => 'Selecione']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('fecha', 'Fecha de sesión :', ['class' => 'col-md-2 control-label']) !!}
			<div class="col-md-9">
				{!! Form::input('date','fecha', $sesgru->fecha, ['class' => 'form-control fechas', 'required', 'placeholder' => 'aaaa-mm-dd']) !!}
			</div>
		</div>

		<div class="form-group">
			<div class="col-md-6 col-md-offset-4">
				{!! Form::button('<span class="glyphicon glyphicon-floppy-save"></span> Editar sesión', ['type' => 'submit', 'class' => 'btn btn-success']) !!}	
				<a href="{{ route('sesgru.index') }}" class="btn btn-danger">
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
