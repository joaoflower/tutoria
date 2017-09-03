@extends('layouts.app')

@section('title','Lista de Coordinadores de Tutoría')

@section('aside')
	@include('layouts.include.aside')
@endsection

@section('content')
	
	<table class="table table-striped table-bordered table-hover ">
		<thead>
			<tr class="success">
				<th>Codigo</th>
				<th>Coordinador</th>
				<th>Escuela</th>
				<th>Acción</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($usuheads as $usuhead)	
				<tr>			
					<td>{{ $usuhead->codigo }}</td>
					<td>{{ ucwords(strtolower($usuhead->name)) }}</td>
					<td>{{ ucwords(strtolower($usuhead->car_des)) }}</td>
					<td>
						<a href="{{ route('usutut.edit', $usuhead->id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="left" title="Editar">
							<i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i>
						</a>
						<a href="{{ route('usutut.destroy', $usuhead->id) }}" onclick="return confirm('¿Estas seguro que quieres eliminar?')" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="right" title="Eliminar">
							<i class="fa fa-trash-o fa-lg" aria-hidden="true"></i>
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
	<a href="{{ route('usutut.create') }}" class="btn btn-primary">
		<i class="fa fa-user-plus fa-lg" aria-hidden="true"></i> Nuevo Coordinador
	</a>
@endsection