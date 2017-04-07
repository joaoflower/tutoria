@extends('layouts.app')

@section('title','Inducción al Estudiante tutorado')

@section('aside')
	@include('layouts.include.aside')
@endsection

@section('content')

	<table class="table table-striped table-bordered table-hover ">
		<tbody>
			<tr>
				<td class="text-right"><strong>Escuela Profesional :</strong></td>
				<td>{{ $induccion->estu->car_des }}</td>
			</tr>
			<tr>
				<td class="text-right"><strong>Tutor :</strong></td>
				<td>{{ $induccion->nameDocente }}</td>
			</tr>
			<tr>
				<td class="text-right"><strong>Tutorado :</strong></td>
				<td>{{ $induccion->nameEstudiante }}</td>
			</tr>
			<tr>
				<td class="text-right"><strong>Fecha de inducción :</strong></td>
				<td>{{ $induccion->fecha }}</td>
			</tr>
		</tbody>
	</table>
	<table class="table table-striped table-bordered table-hover">
		<thead>
			<tr>
				<th colspan="2" class="text-center">ITEMS</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($iteminducs as $item)
			<tr>
				<td>{{ $item->name }}</td>
				<td><strong>{{ $induccion_item[$item->id] }}</strong></td>
			</tr>
			@endforeach
		</tbody>
		<thead>
			<tr>
				<th colspan="2" class="text-center">RESPECTO AL PROCESO EN GENERAL</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($procinducs as $proc)
			<tr>
				<td>{{ $proc->name }}</td>
				<td><strong>{{  $induccion_proc[$proc->id] }}</strong></td>
			</tr>
			@endforeach
		</tbody>
	</table>
	<table class="table table-striped table-bordered table-hover ">
		<tbody>
			<tr>
				<td><strong>Algún tema para la próxima reunión o comentario</strong></td>
			</tr>
			<tr>
				<td class="textoDB">{{ $induccion->tem_pro }}</td>
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
	<a href="{{ route('grupo.show', $induccion->estugrupo->grupo_id) }}" class="btn btn-success btn-custom">
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
