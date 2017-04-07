@extends('layouts.app')

@section('title','Lista de Tutores')

@section('aside')
	@include('layouts.include.aside')
@endsection

@section('content')
	
	<table class="table table-striped table-bordered table-hover ">
		<thead>
			<tr class="success">
				<th>Estudiante</th>
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
						<a href="#" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Evaluación">
							<i class="fa fa-check-circle-o"></i> 
							@if($evalestu != null) 
								<span class="badge">1</span>
							@endif
						</a>
					</td>
				</tr>
			@endif
		</tbody>
	</table>
	<div class="text-center">
		
	</div>
@endsection

