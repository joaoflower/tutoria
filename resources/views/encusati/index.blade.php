@extends('layouts.app')

@section('title','[2017-I] Lista de Constancias de Tutoría')

@section('aside')
	@include('layouts.include.aside')
@endsection

@section('content')
	
	<table class="table table-striped table-bordered table-hover ">
		<thead>
			<tr class="success">
				<th>Constancia</th>
				<th>Acción</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($encusatis as $encusati)
				<tr>
					<td>Constancia de Tutoría Nro {{ $encusati->id }}</td>
					<td>
						<a href="{{ route('encusati.show', $encusati->id) }}" class="btn btn-success btn-sm">
							<span class="glyphicon glyphicon-file" aria-hidden="true"> Generar </span>
						</a>
						<!--<a href="{{ route('encusati.edit', $encusati->id) }}" class="btn btn-warning btn-sm">
							<span class="glyphicon glyphicon-edit" aria-hidden="true"> Editar </span>
						</a>						
						<a href="{{ route('encusati.destroy', $encusati->id) }}" onclick="return confirm('¿Estas seguro que quieres eliminar?')" class="btn btn-danger btn-sm">
							<span class="glyphicon glyphicon-remove" aria-hidden="true"> Borrar</span>
						</a>-->
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	<div class="text-center">
		
	</div>
@endsection

@section('footer')	
@endsection