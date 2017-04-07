@extends('layouts.app')

@section('title','Lista de Evaluación del Tutor')

@section('aside')
	@include('layouts.include.aside')
@endsection

@section('content')
	
	<table class="table table-striped table-bordered table-hover ">
		<thead>
			<tr class="success">
				<th>Num. Mat.</th>
				<th>Tutorado</th>
				<th>Escala</th>
				<th>Acción</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($estugrupos as $estugrupo)
				@if ($estugrupo->evaldoc != null)
					<?php $escala = 0; ?>
					@foreach($estugrupo->evaldoc->itemevaldocs as $itemevaldoc)
					 	<?php $escala += $itemevaldoc->escala; ?>
					@endforeach
				<tr>
					<td>{{ $estugrupo->num_mat }}</td>
					<td>{{ $estugrupo->name }}</td>
					<td>{{ $escala }}</td>
					<td>
						<a href="{{ route('evaldoc.edit', $estugrupo->evaldoc->id) }}" class="btn btn-warning btn-sm">
							<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
						</a>
						<a href="{{ route('evaldoc.destroy', $estugrupo->evaldoc->id) }}" onclick="return confirm('¿Estas seguro que quieres eliminar?')" class="btn btn-danger btn-sm">
							<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
						</a>
					</td>
				</tr>
				@endif
			@endforeach
		</tbody>
	</table>
	<div class="text-center">
		
	</div>
@endsection

@section('footer')
	<a href="{{ route('evaldoc.create') }}" class="btn btn-primary">
		<span class="glyphicon glyphicon-file" aria-hidden="true"></span> Nueva Evaluación
	</a>
@endsection