@extends('layouts.app')

@section('title','Lista de Tutores')

@section('aside')
	@include('layouts.include.aside')
@endsection

@section('content')
	
	<table class="table table-striped table-bordered table-hover ">
		<thead>
			<tr class="success">
				<th>Docente</th>
				<th>Escuela Profesional</th>
				<th>Acción</th>
			</tr>
		</thead>
		<tbody>
			@if ($docente != null)
				<tr>
					<td>{{ ucwords(strtolower($docente->name)) }}</td>
					<td>{{ ucwords(strtolower($docente->car_des)) }}</td>
					<td>

					</td>
				</tr>
			@endif
		</tbody>
	</table>
	<div class="text-center">
		
	</div>
@endsection

