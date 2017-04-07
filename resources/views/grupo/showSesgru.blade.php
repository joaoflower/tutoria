@extends('layouts.app')

@section('title','Tutoría grupal por sesión')

@section('aside')
	@include('layouts.include.aside')
@endsection

@section('content')

	<table class="table table-striped table-bordered table-hover ">
		<tbody>
			<tr>
				<td class="text-right"><strong>Escuela Profesional :</strong></td>
				<td></td>
			</tr>
			<tr>
				<td class="text-right"><strong>Tutor :</strong></td>
				<td>{{ $sesgru->nameDocente }}</td>
			</tr>
			<tr>
			<tr>
				<td class="text-right"><strong>Fecha de sesión :</strong></td>
				<td>{{ $sesgru->fecha }}</td>
			</tr>
		</tbody>
	</table>
	
	<table class="table table-striped table-bordered table-hover">
		<thead>
			<tr>
				<th>Tutorados</th>
				<th>Asistencia</th>
				<th>Evaluación</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($estudiantes as $estugrupo_id => $name)
			<tr>
				<td>{{ $name }}</td>
				<td><strong>{{ $asi_ests[$estugrupo_id] }}</strong></td>
				<td><strong>{{ $evalsess[$evalses_ids[$estugrupo_id]] }}</strong></td>
			</tr>
			@endforeach
		</tbody>
	</table>
	<table class="table table-striped table-bordered table-hover">
		<thead>
			<tr>
				<th>Evaluación del grupo :</th>
				<th>{{ $evalsess[$sesgru->evalses_id] }}</th>
			</tr>
		</thead>
	</table>	
	<table class="table table-striped table-bordered table-hover ">
		<tbody>
			<tr>
				<td><strong>Temas tratados en la sesión :</strong></td>
			</tr>
			<tr>
				<td class="textoDB">{{ $sesgru->tem_ses }}</td>
			</tr>
		</tbody>
	</table>
	<table class="table table-striped table-bordered table-hover ">
		<tbody>
			<tr>
				<td><strong>Problemas y demandas detectados en la sesión :</strong></td>
			</tr>
			<tr>
				<td class="textoDB">{{ $sesgru->pro_ses }}</td>
			</tr>
		</tbody>
	</table>
	<table class="table table-striped table-bordered table-hover ">
		<tbody>
			<tr>
				<td><strong>Acuerdos y soluciones resultantes de la sesión :</strong></td>
			</tr>
			<tr>
				<td class="textoDB">{{ $sesgru->acu_ses }}</td>
			</tr>
		</tbody>
	</table>
	<table class="table table-striped table-bordered table-hover ">
		<tbody>
			<tr>
				<td><strong>Observaciones del tutor sobre la dinámica del grupo o algún(os) tutorado(s) en particular :</strong></td>
			</tr>
			<tr>
				<td class="textoDB">{{ $sesgru->obs_ses }}</td>
			</tr>
		</tbody>
	</table>


	<div class="text-center">
		
	</div>
@endsection

@section('footer')
	<a href="{{ route('grupo.index') }}" class="btn btn-primary btn-custom">
		<i class="fa fa-graduation-cap fa-lg" aria-hidden="true"></i> Ver lista de tutorias
	</a>
	<a href="{{ route('grupo.show', $sesgru->grupo_id) }}" class="btn btn-success btn-custom">
		<i class="fa fa-users fa-lg" aria-hidden="true"></i> Ver lista de tutorados
	</a>
@endsection
@section('js')
	<script type="text/javascript">
	$(function() {
		$('.textoDB').each(function() { $(this).html($(this).text()); });
	});
	</script>
@endsection
