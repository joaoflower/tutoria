@extends('layouts.app')

@section('title','Tutoria individual por sessión')

@section('aside')
	@include('layouts.include.aside')
@endsection

@section('content')

	<table class="table table-striped table-bordered table-hover ">
		<tbody>
			<tr>
				<td class="text-right"><strong>Escuela Profesional :</strong></td>
				<td>{{ $sesindi->estu->car_des }}</td>
			</tr>
			<tr>
				<td class="text-right"><strong>Tutor :</strong></td>
				<td>{{ $sesindi->nameDocente }}</td>
			</tr>
			<tr>
				<td class="text-right"><strong>Tutorado :</strong></td>
				<td>{{ $sesindi->nameEstudiante }}</td>
			</tr>
			<tr>
				<td class="text-right"><strong>Fecha de sesión :</strong></td>
				<td>{{ $sesindi->fecha }}</td>
			</tr>
		</tbody>
	</table>
	<table class="table table-striped table-bordered table-hover">
		<thead>
			<tr>
				<th colspan="2">Temas que se trataron en la sesión: </th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td class="text-right"><strong>Académicos:</strong></td>
				<td class="textoDB">{{ $sesindi->tem_aca }}</td>
			</tr>
			<tr>
				<td class="text-right"><strong>Personales:</strong></td>
				<td class="textoDB">{{ $sesindi->tem_per }}</td>
			</tr>
		</tbody>
	</table>
	<table class="table table-striped table-bordered table-hover">
		<thead>
			<tr>
				<th colspan="2">Problemas o demandas que se encontraron en la sesión: </th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td class="text-right"><strong>Académicos:</strong></td>
				<td class="textoDB">{{ $sesindi->pro_aca }}</td>
			</tr>
			<tr>
				<td class="text-right"><strong>Personales:</strong></td>
				<td class="textoDB">{{ $sesindi->pro_per }}</td>
			</tr>
		</tbody>
	</table>
	<table class="table table-striped table-bordered table-hover">
		<thead>
			<tr>
				<th colspan="2">Acuerdos y/o soluciones resultantes de la sesión: </th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td class="text-right"><strong>Académicos:</strong></td>
				<td class="textoDB">{{ $sesindi->acu_aca }}</td>
			</tr>
			<tr>
				<td class="text-right"><strong>Personales:</strong></td>
				<td class="textoDB">{{ $sesindi->acu_per }}</td>
			</tr>
		</tbody>
	</table>
	<table class="table table-striped table-bordered table-hover">
		<thead>
			<tr>
				<th colspan="2">Observaciones del tutor sobre la dinámica del grupo o de algún(os) estudiante(s) en particular: </th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td class="text-right"><strong>Académicos:</strong></td>
				<td class="textoDB">{{ $sesindi->obs_aca }}</td>
			</tr>
			<tr>
				<td class="text-right"><strong>Personales:</strong></td>
				<td class="textoDB">{{ $sesindi->obs_per }}</td>
			</tr>
		</tbody>
	</table>
	<table class="table table-striped table-bordered table-hover">
		<tbody>
			<tr>
				<td>Consigne una evaluación de la sesión:</td>
				<td><strong>{{ $evalsess[$sesindi->evalses_id] }}</strong></td>
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
	<a href="{{ route('grupo.show', $sesindi->estugrupo->grupo_id) }}" class="btn btn-success btn-custom">
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
