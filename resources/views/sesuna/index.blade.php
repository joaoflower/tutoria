@extends('layouts.app')

@section('title','[2017-I] Lista de sesión de Tutoria individual')

@section('aside')
	@include('layouts.include.aside')
@endsection

@section('content')
	<a href="{{ route('sesuna.create') }}" class="btn btn-primary">
		<span class="glyphicon glyphicon-file" aria-hidden="true"></span> Nueva Sessión
	</a>
	
	<table class="table table-striped table-bordered table-hover ">
		<thead>
			<tr class="success">
				<th>Num.Mat.</th>
				<th>Estudiante</th>
				<th>Sesión</th>
				<th>Fecha</th>
				<th>Acción</th>
			</tr>
		</thead>
		<tbody>
			@if($sesindi17s != null)
			@foreach ($sesindi17s as $sesindi)
				<tr>
					<td>{{ $sesindi->num_mat }}</td>
					<td>{{ ucwords(strtolower($sesindi->name)) }}</td>
					<td>{{ $sesindi->nro_ses }}</td>
					<td>{{ $sesindi->fecha }}</td>
					<td>
						<a href="{{ route('sesuna.edit', $sesindi->id) }}" class="btn btn-warning btn-sm">
							<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
						</a>
						<a href="{{ route('sesuna.destroy', $sesindi->id) }}" onclick="return confirm('¿Estas seguro que quieres eliminar?')" class="btn btn-danger btn-sm">
							<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
						</a>
					</td>
				</tr>
			@endforeach
			@endif
		</tbody>
	</table>
	<div class="text-center">
		
	</div>
@endsection

@section('footer')
	<a href="{{ route('sesuna.create') }}" class="btn btn-primary">
		<span class="glyphicon glyphicon-file" aria-hidden="true"></span> Nueva Sessión
	</a>
@endsection