@extends('layouts.app')

@section('title','Lista de Informe Técnico Académico de Tutorado')

@section('aside')
	@include('layouts.include.aside')
@endsection

@section('content')
	
	<table class="table table-striped table-bordered table-hover ">
		<thead>
			<tr class="success">
				<th>Meses</th>
				<th>Tutor</th>
				<th>Fecha</th>
				<th>Acción</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($itaestus as $itaestu)
				<tr>
					<td>{{ $itaestu->meses }}</td>
					<td>{{ $docente }}</td>
					<td>{{ $itaestu->fecha }}</td>
					<td>
						<a href="{{ route('itaestu.edit', $itaestu->id) }}" class="btn btn-warning btn-sm">
							<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
						</a>
						<a href="{{ route('itaestu.destroy', $itaestu->id) }}" onclick="return confirm('¿Estas seguro que quieres eliminar?')" class="btn btn-danger btn-sm">
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
	<a href="{{ route('itaestu.create') }}" class="btn btn-primary">
		<span class="glyphicon glyphicon-file" aria-hidden="true"></span> Nuevo Informe
	</a>
@endsection