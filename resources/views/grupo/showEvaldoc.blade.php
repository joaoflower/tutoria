@extends('layouts.app')

@section('title','Evaluación del Docente Tutor')

@section('aside')
	@include('layouts.include.aside')
@endsection

@section('content')

	<table class="table table-striped table-bordered table-hover ">
		<tbody>
			<tr>
				<td class="text-right"><strong>Escuela Profesional :</strong></td>
				<td>{{ $evaldoc->estu->car_des }}</td>
			</tr>
			<tr>
				<td class="text-right"><strong>Tutor :</strong></td>
				<td>{{ $evaldoc->nameDocente }}</td>
			</tr>
			<tr>
				<td class="text-right"><strong>Tutorado :</strong></td>
				<td>{{ $evaldoc->nameEstudiante }}</td>
			</tr>

			<?php $count = 0; ?>
			@foreach ($itemevaldocs as $itemevaldoc)
				<?php $count += $evaldoc_item[$itemevaldoc->id]; ?>
			@endforeach
			
			<tr>
				<td class="text-right"><strong>Escala :</strong></td>
				<td>{{ $count }}</td>
			</tr>
		</tbody>
	</table>
	
	<table class="table table-striped table-bordered table-hover">
		<thead>
			<tr>
				<th colspan="2">ITEMS A EVALUAR</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($itemevaldocs as $itemevaldoc)
			<tr>
				<td>{{ $itemevaldoc->name }}</td>
				<td><strong>{{ $evaldoc_leyenda[$evaldoc_item[$itemevaldoc->id]] }}</strong></td>
			</tr>
			@endforeach
		</tbody>
	</table>

	
	<table class="table table-striped table-bordered table-hover ">
		<tbody>
			<tr>
				<td><strong>Observaciones y sugerencias :</strong></td>
			</tr>
			<tr>
				<td class="textoDB">{{ $evaldoc->obs_sug }}</td>
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
	<a href="{{ route('grupo.show', $evaldoc->estugrupo->grupo_id) }}" class="btn btn-success btn-custom">
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
