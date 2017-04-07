@extends('layouts.app')

@section('title','Lista de Informes Técnico Académicos del Tutor')

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
			@foreach ($estugrupos as $estugrupo)
				@foreach ($estugrupo->itadocs as $itadoc)
				<tr>
					<td>{{ $itadoc->meses }}</td>
					<td>{{ $estugrupo->name }}</td>
					<td>{{ $itadoc->fecha }}</td>
					<td>
						<a href="{{ route('itadoc.edit', $itadoc->id) }}" class="btn btn-warning btn-sm">
							<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
						</a>
						<a href="{{ route('itadoc.destroy', $itadoc->id) }}" onclick="return confirm('¿Estas seguro que quieres eliminar?')" class="btn btn-danger btn-sm">
							<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
						</a>
					</td>
				</tr>
				@endforeach
			@endforeach
		</tbody>
	</table>
	<div class="text-center">
		
	</div>
@endsection

@section('footer')
	<a href="{{ route('itadoc.create') }}" class="btn btn-primary">
		<span class="glyphicon glyphicon-file" aria-hidden="true"></span> Nuevo Informe
	</a>
@endsection