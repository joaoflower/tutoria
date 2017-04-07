@extends('layouts.app')

@section('title','Lista de Inducciones')

@section('aside')
	@include('layouts.include.aside')
@endsection

@section('content')
	
	<table class="table table-striped table-bordered table-hover ">
		<thead>
			<tr class="success">
				<th>Num.Mat.</th>
				<th>Estudiante</th>
				<th>Fecha</th>
				<th>Acción</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($inducciones as $induccion)
				<tr>
					<td>{{ $induccion->num_mat }}</td>
					<td>{{ ucwords(strtolower($induccion->name)) }}</td>
					<td>{{ $induccion->fecha }}</td>
					<td>
						<a href="{{ route('induccion.edit', $induccion->id) }}" class="btn btn-warning btn-sm">
							<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
						</a>
						<a href="{{ route('induccion.destroy', $induccion->id) }}" onclick="return confirm('¿Estas seguro que quieres eliminar?')" class="btn btn-danger btn-sm">
							<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
						</a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	<div class="text-center">
		
	</div>
@endsection

@section('footer')
	<a href="{{ route('induccion.create') }}" class="btn btn-primary">
		<span class="glyphicon glyphicon-file" aria-hidden="true"></span> Nueva Inducción
	</a>
@endsection