@extends('layouts.app')

@section('title','Lista de Tutorados de '.$grupo->nameDocente)

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
				<th>Formatos</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($estugrupos as $estugrupo)
				<tr>
					<td>{{ $estugrupo->num_mat }}</td>
					<td>{{ ucwords(strtolower($estugrupo->name)) }}</td>
					<td>{{ ucwords(strtolower($estugrupo->car_des)) }}</td>
					<td>
					@if($estugrupo->induccion != null) 
						<a href="{{ route('grupo.induccion', $estugrupo->induccion->id) }}" class="btn btn-primary" data-toggle="tooltip" data-placement="left" title="Ver inducción">
							<i class="fa fa-share-alt"></i> <span class="badge">1</span>
						</a>
					@else
						<a href="#" class="btn btn-primary" data-toggle="tooltip" data-placement="left" title="No hay Inducción">
							<i class="fa fa-share-alt"></i> 
						</a>
					@endif

					<?php $count = 1; ?>
					@if($estugrupo->count_sesi > 0) 
						@foreach ($estugrupo->sesindis as $sesindi)
						<a href="{{ route('grupo.sesindi', $sesindi->id) }}" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Ver tutoria individual {{ $count }}">
							<i class="fa fa-user"></i> <span class="badge">{{ $count }}</span>
						</a>		
						<?php $count = $count + 1; ?>
						@endforeach						
					@else
						<a href="#" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="No hay tutoria individual">
							<i class="fa fa-user"></i>
						</a>
					@endif

					<?php $count = 1; ?>
					@if($estugrupo->count_itad > 0) 
						@foreach ($estugrupo->itadocs as $itadoc)
						<a href="{{ route('grupo.itadoc', $itadoc->id) }}" class="btn btn-info" data-toggle="tooltip" data-placement="bottom" title="Ver Inf. Tec. Acad. {{ $count }}">
							<i class="fa fa-file-archive-o"></i><span class="badge">{{ $count }}</span>
						</a>
						<?php $count = $count + 1; ?>
						@endforeach						
					@else
						<a href="#" class="btn btn-info" data-toggle="tooltip" data-placement="bottom" title="No hay Inf. Tec. Acad.">
							<i class="fa fa-file-archive-o"></i> 
						</a>
					@endif

					@if($estugrupo->evaldoc != null)
						<a href="{{ route('grupo.evaldoc', $estugrupo->evaldoc->id) }}" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Ver Evaluación">
							<i class="fa fa-check-circle-o"></i> <span class="badge">1</span>
						</a>
					@else
						<a href="#" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="No hay Evaluación">
							<i class="fa fa-check-circle-o"></i>
						</a>
					@endif

					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	<div class="text-center">
		<?php $count = 1; ?>
		@if($grupo->count_sesg > 0) 
			@foreach ($grupo->sesgrus as $sesgru)
			<a href="{{ route('grupo.sesgru', $sesgru->id) }}" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Ver tutoria grupal {{ $count }}">
				<i class="fa fa-users"></i> <span class="badge">{{ $count }}</span>
			</a>		
			<?php $count = $count + 1; ?>
			@endforeach						
		@else
			<a href="#" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="No hay tutoria grupal">
				<i class="fa fa-users"></i>
			</a>
		@endif
		
	</div>
@endsection

@section('footer')
	<a href="{{ route('grupo.index') }}" class="btn btn-primary btn-custom">
		<i class="fa fa-graduation-cap fa-lg" aria-hidden="true"></i>Ver lista de tutorias
	</a>
@endsection
