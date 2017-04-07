@extends('layouts.app')

@section('title','Lista de Evaluación del Estudiante Tutorado')

@section('aside')
	@include('layouts.include.aside')
@endsection

@section('content')
	
	<table class="table table-striped table-bordered table-hover ">
		<thead>
			<tr class="success">
				<th>Tutor</th>
				<th>Escala</th>
				<th>Acción</th>
			</tr>
		</thead>
		<tbody>
			@if($evalestu != null)
				<tr>
					<td>{{ $docente }}</td>
					<td>{{ $escala }}</td>
					<td>
						<a href="{{ route('evalestu.edit', $evalestu->id) }}" class="btn btn-warning btn-sm">
							<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
						</a>
						<a href="{{ route('evalestu.destroy', $evalestu->id) }}" onclick="return confirm('¿Estas seguro que quieres eliminar?')" class="btn btn-danger btn-sm">
							<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
						</a>
					</td>
				</tr>
			@endif
		</tbody>
	</table>
	<div class="text-center">
		
	</div>
@endsection

@section('footer')
	<a href="{{ route('evalestu.create') }}" class="btn btn-primary">
		<span class="glyphicon glyphicon-file" aria-hidden="true"></span> Nueva Evaluación
	</a>
@endsection