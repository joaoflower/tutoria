@extends('layouts.app')

@section('title','Informe Técnico Académico del Tutor')

@section('aside')
	@include('layouts.include.aside')
@endsection

@section('content')

	<table class="table table-striped table-bordered table-hover ">
		<tbody>
			<tr>
				<td class="text-right"><strong>Escuela Profesional :</strong></td>
				<td>{{ $itadoc->estu->car_des }}</td>
			</tr>
			<tr>
				<td class="text-right"><strong>Tutor :</strong></td>
				<td>{{ $itadoc->nameDocente }}</td>
			</tr>
			<tr>
				<td class="text-right"><strong>Tutorado :</strong></td>
				<td>{{ $itadoc->nameEstudiante }}</td>
			</tr>
			<tr>
				<td class="text-right"><strong>Fecha de sesión :</strong></td>
				<td>{{ $itadoc->fecha }}</td>
			</tr>
			<tr>
				<td class="text-right"><strong>Meses :</strong></td>
				<td>{{ $mesitas[$itadoc->mesita_id] }}</td>
			</tr>
		</tbody>
	</table>
	
	<table class="table table-striped table-bordered table-hover">
		<thead>
			<tr>
				<th colspan="2">1. ¿Qué dificultades ha presentado el estudiante tutorado en los últimos 02 meses? :</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($dificultads as $dificultad)
			<tr>
				<td>{{ $dificultad->name }}</td>
				<td><strong>{{ $itadoc_dific[$dificultad->id] }}</strong></td>
			</tr>
			@endforeach
		</tbody>
	</table>

	<table class="table table-striped table-bordered table-hover">
		<thead>
			<tr>
				<th>2. ¿Cree que el estudiante tutorado ha resuelto estas actividades por medio de la tutoría? :</th>
				<th>{{ $itadoc->res_dif }}</th>
			</tr>
		</thead>
	</table>

	<table class="table table-striped table-bordered table-hover">
		<thead>
			<tr>
				<th colspan="2">3. ¿En el ámbito Académico qué avances se perciben? :</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($avanceacas as $avanceaca)
			<tr>
				<td>{{ $avanceaca->name }}</td>
				<td><strong>{{ $itadoc_avaca[$avanceaca->id] }}</strong></td>
			</tr>
			@endforeach
		</tbody>
	</table>

	<table class="table table-striped table-bordered table-hover">
		<thead>
			<tr>
				<th colspan="2">4. En el ámbito Personal y Social qué avances se perciben? :</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($avancepess as $avancepes)
			<tr>
				<td>{{ $avancepes->name }}</td>
				<td><strong>{{ $itadoc_avpes[$avancepes->id] }}</strong></td>
			</tr>
			@endforeach
		</tbody>
	</table>

	<table class="table table-striped table-bordered table-hover ">
		<tbody>
			<tr>
				<td><strong>Recomendaciones y sugerencias :</strong></td>
			</tr>
			<tr>
				<td class="textoDB">{{ $itadoc->rec_sug }}</td>
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
	<a href="{{ route('grupo.show', $itadoc->estugrupo->grupo_id) }}" class="btn btn-success btn-custom">
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
