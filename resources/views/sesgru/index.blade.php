@extends('layouts.app')

@section('title','Lista de Tutoría grupal por sessión')

@section('aside')
	@include('layouts.include.aside')
@endsection

@section('content')
	
	<table class="table table-striped table-bordered table-hover ">
		<thead>
			<tr class="success">
				<th>Sesión</th>
				<th>Fecha</th>
				<th>Acción</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($sesgrus as $sesgru)
				<tr>
					<td>{{ $sesgru->nro_ses }}</td>
					<td>{{ $sesgru->fecha }}</td>
					<td>
						<a href="{{ route('sesgru.edit', $sesgru->id) }}" class="btn btn-warning btn-sm">
							<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
						</a>
						<a href="{{ route('sesgru.destroy', $sesgru->id) }}" onclick="return confirm('¿Estas seguro que quieres eliminar?')" class="btn btn-danger btn-sm">
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
	<a href="{{ route('sesgru.create') }}" class="btn btn-primary">
		<span class="glyphicon glyphicon-file" aria-hidden="true"></span> Nueva Sessión
	</a>
@endsection