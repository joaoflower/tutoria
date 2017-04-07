@extends('layouts.app')
@section('title', 'Agregar Inducción al Estudiante tutorado')

@section('aside')
	@include('layouts.include.aside')
@endsection

@section('content')
	{!! Form::open(['route' => 'induccion.store', 'method' => 'POST', 'class' => 'form-horizontal']) !!}

		<div class="form-group">
			{!! Form::label('tutor', 'Tutor :', ['class' => 'col-md-2 control-label']) !!}
			<div class="col-md-9">
				<p class="form-control-static">{{ $docente }}</p>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('estugrupo_id', 'Tutorado :', ['class' => 'col-md-2 control-label']) !!}
			<div class="col-md-9">
				{!! Form::select('estugrupo_id', $estudiantes, null, ['class' => 'form-control select-estudiante', 'required', 'data-placeholder' => 'Seleciones Turorado']) !!}
			</div>
		</div>

		<div class="form-group">
			{!! Form::label('items', 'Items :', ['class' => 'col-md-2 control-label']) !!}
			<div class="col-md-9">
				<table class="table table-striped table-bordered table-hover ">
					<tbody>
						@foreach ($iteminducs as $item)
							<tr>
								<td>{{ $item->name }}</td>
								<td>
									{!! Form::select('eva_items['.$item->id.']', ['MUY CLARA' => 'Muy clara', 'CLARA' => 'Clara', 'POCO CLARA' => 'Poco clara'], null, ['class' => 'form-control', 'required']) !!}
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('procs', 'Respecto al proceso en general :', ['class' => 'col-md-2 control-label']) !!}
			<div class="col-md-9">
				<table class="table table-striped table-bordered table-hover ">
					<tbody>
						@foreach ($procinducs as $proc)
							<tr>
								<td>{{ $proc->name }}</td>
								<td>
									{!! Form::select('eva_procs['.$proc->id.']', ['MUY BUENO' => 'Muy bueno', 'BUENO' => 'Bueno', 'REGULAR' => 'Regular'], null, ['class' => 'form-control', 'required']) !!}
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('tem_pro', 'Tema para la próxima reunión :', ['class' => 'col-md-2 control-label']) !!}
			<div class="col-md-9">
				{!! Form::textarea('tem_pro', null, ['class' => 'form-control area-content', 'placeholder' => 'Ingrese algún tema para la próxima reunión o comentario', 'required', 'size' => '50x3']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('fecha', 'Fecha de inducción :', ['class' => 'col-md-2 control-label']) !!}
			<div class="col-md-9">
				{!! Form::input('date','fecha', null, ['class' => 'form-control fechas', 'required', 'placeholder' => 'aaaa-mm-dd']) !!}
			</div>
		</div>

		<div class="form-group">
			<div class="col-md-6 col-md-offset-4">
				{!! Form::button('<span class="glyphicon glyphicon-floppy-save"></span> Agregar sesión', ['type' => 'submit', 'class' => 'btn btn-success']) !!}	
				<a href="{{ route('induccion.index') }}" class="btn btn-danger">
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
