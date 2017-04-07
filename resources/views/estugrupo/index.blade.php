@extends('layouts.app')

@section('title','Lista de Tutorados')

@section('aside')
	@include('layouts.include.aside')
@endsection

@section('content')
	
	<table class="table table-striped table-bordered table-hover ">
		<thead>
			<tr class="success">
				<th>Num.Mat.</th>
				<th>Estudiante</th>
				<th>Escuela Profesional</th>
				<th>Acción</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($estugrupos as $estugrupo)
				<tr>
					<td>{{ $estugrupo->num_mat }}</td>
					<td>{{ ucwords(strtolower($estugrupo->name)) }}</td>
					<td>{{ ucwords(strtolower($estugrupo->car_des)) }}</td>
					<td>
						<a href="#" class="btn btn-primary" data-toggle="tooltip" data-placement="left" title="Inducción">
							<i class="fa fa-share-alt"></i> 
							@if($estugrupo->induccion != null) 
								<span class="badge">1</span>
							@endif
						</a>
						<a href="#" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Tutoria individual">
							<i class="fa fa-user"></i> 
							@if($estugrupo->count_sesi > 0) 
								<span class="badge">{{ $estugrupo->count_sesi }}</span>
							@endif
						</a>
						<a href="#" class="btn btn-info" data-toggle="tooltip" data-placement="bottom" title="Inf. Tec. Acad.">
							<i class="fa fa-file-archive-o"></i> 
							@if($estugrupo->count_itad > 0) 
								<span class="badge">{{ $estugrupo->count_itad }}</span>
							@endif
						</a>
						<a href="#" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Evaluación">
							<i class="fa fa-check-circle-o"></i> 
							@if($estugrupo->evaldoc != null)  
								<span class="badge">1</span>
							@endif
						</a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	<div class="text-center">
		
	</div>
@endsection
