@extends('layouts.app')
@section('title', 'Agregar Evaluación del Tutor')

@section('aside')
	@include('layouts.include.aside')
@endsection

@section('content')
	{!! Form::open(['route' => 'evaldoc.store', 'method' => 'POST', 'class' => 'form-horizontal']) !!}

		<div class="form-group">
			{!! Form::label('tutor', 'Tutor :', ['class' => 'col-md-2 control-label']) !!}
			<div class="col-md-9">
				<p class="form-control-static">{{ $docente }}</p>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('tutorado', 'Tutorado :', ['class' => 'col-md-2 control-label']) !!}
			<div class="col-md-9">
				{!! Form::select('estugrupo_id', $estudiantes, null, ['class' => 'form-control select-estudiante', 'required', 'data-placeholder' => 'Seleciones Turorado']) !!}
			</div>
		</div>

		<div class="form-group">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				<p class="form-control-static"><strong>ESTIMADO DOCENTE: </strong> El presente instrumento tiene por finalidad evaluar el desempeño del tutorado a su cargo, y de esta manera retroalimentar y mejorar la labor de tutoría que desempeña, por lo que se solicita responder objetiva y sinceramente.</p>
				<p>A continuación encontrará afirmaciones que le permitirán reflexionar sobre el desempeño del tutorado a su cargo, teniedo en cuenta la siguiente escala.</p>
			</div>
		</div>

		<div class="form-group">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				<table class="table table-striped table-bordered table-hover ">
					<thead>
						<tr class="success">
							<th>Item a Evaluar</th>
							<th width="200">Escala</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($itemevaldocs as $itemevaldoc)
							<tr>
								<td>{{ $itemevaldoc->name }}</td>
								<td>
									{!! Form::select('evaldoc_item['.$itemevaldoc->id.']', ['1' => 'NUNCA', '2' => 'RARA VEZ', '3' => 'FRECUENTEMENTE', '4' => 'CASI SIEMPRE', '5' => 'SIEMPRE'], null, ['class' => 'form-control', 'required']) !!} 
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
		
		<div class="form-group">
			{!! Form::label('obs_sug', 'Observaciones o sugerencia :', ['class' => 'col-md-2 control-label']) !!}
			<div class="col-md-9">
				{!! Form::textarea('obs_sug', null, ['class' => 'form-control area-content', 'placeholder' => 'Ingrese sus Observaciones o sugerencia', 'required', 'size' => '50x3']) !!}
			</div>
		</div>
		

		<div class="form-group">
			<div class="col-md-6 col-md-offset-4">
				{!! Form::button('<span class="glyphicon glyphicon-floppy-save"></span> Agregar Evaluación', ['type' => 'submit', 'class' => 'btn btn-success']) !!}	
				<a href="{{ route('evaldoc.index') }}" class="btn btn-danger">
					<span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Cancelar
				</a>
			</div>
		</div>
	{!! Form::close() !!}
@endsection
@section('js')
	<script type="text/javascript">
		$('.select-estudiante').chosen({
			allow_single_deselect: true
		});
		$('.area-content').trumbowyg({
		    fullscreenable: false,
		    btns: [ ['formatting'], 'btnGrp-semantic', ['link'], 'btnGrp-justify', 'btnGrp-lists']	 ,
		    autogrow: true   
		});
	</script>
@endsection
