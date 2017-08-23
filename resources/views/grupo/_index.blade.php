@extends('layouts.app')

@section('title','Lista de Tutorías')

@section('aside')
	@include('layouts.include.aside')
@endsection

@section('content')
	
	<table class="table table-striped table-bordered table-hover ">
		<thead>
			<tr class="success">
				<th>ID</th>
				<th>Nombre</th>
				<th>Docente Tutor</th>
				<th>Acción</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($grupos as $grupo)
			<tr>
				<td>{{ $grupo->id }}</td>
				<td>{{ $grupo->name }}</td>
				<td>{{ ucwords(strtolower($grupo->paterno.' '.$grupo->materno.', '.$grupo->nombres)) }}</td>
				<td>
					<a href="{{ route('grupo.edit', $grupo->id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="left" title="Editar Tutorados">
						<i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i>
					</a>
					<a href="{{ route('grupo.destroy', $grupo->id) }}" onclick="return confirm('¿Estas seguro que quieres eliminar?')" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Eliminar Tutoría">
						<i class="fa fa-trash-o fa-lg" aria-hidden="true"></i>
					</a>
					<a href="{{ route('grupo.show', $grupo->id) }}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="right" title="Ver Tutorados">
						<i class="fa fa-list fa-lg" aria-hidden="true"></i>
					</a>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	<div class="text-center">
		{!! $grupos->render() !!}
	</div>
@endsection

@section('footer')
	<a href="{{ route('grupo.create') }}" class="btn btn-primary btn-custom">
		<span class="glyphicon glyphicon-file" aria-hidden="true"></span> Nueva Tutoría
	</a>
@endsection