@extends('layouts.app')
@section('title', 'Agregar Evaluación del Estudiante Tutorado')

@section('aside')
	@include('layouts.include.aside')
@endsection

@section('content')
	{!! Form::open(['route' => 'evalestu.store', 'method' => 'POST', 'class' => 'form-horizontal']) !!}

		<div class="form-group">
			{!! Form::label('tutor', 'Tutor :', ['class' => 'col-md-2 control-label']) !!}
			<div class="col-md-9">
				<p class="form-control-static">{{ $docente }}</p>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('tutorado', 'Tutorado :', ['class' => 'col-md-2 control-label']) !!}
			<div class="col-md-9">
				<p class="form-control-static">{{ $estudiante }}</p>
			</div>
		</div>

		<div class="form-group">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				<p class="form-control-static"><strong>Estimado estudiante tutorado: </strong> El presente instrumento tiene la finalidad de evaluar el desempeño del tutor, para poder retroalimentar y mejorar la tutoría. Por ello se solicita responder de manera objetiva, sincera y respetuosa. El manejo de la información es totalmente confidencial.</p>
				<p>A continuación encontrará afirmaciones que le permitirán reflexionar sobre el desempeño de su docente tutor.</p>
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
						@foreach ($itemevalestus as $itemevalestu)
							<tr>
								<td>{{ $itemevalestu->name }}</td>
								<td>
									{!! Form::select('evalestu_item['.$itemevalestu->id.']', ['1' => 'NUNCA', '2' => 'RARA VEZ', '3' => 'FRECUENTEMENTE', '4' => 'CASI SIEMPRE', '5' => 'SIEMPRE'], null, ['class' => 'form-control', 'required']) !!} 
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
				<a href="{{ route('evalestu.index') }}" class="btn btn-danger">
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
