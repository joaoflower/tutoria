@extends('layouts.app')

@section('title','Agregar Tutoría')

@section('aside')
	@include('layouts.include.aside')
@endsection

@section('content')
	{!! Form::open(['route' => 'grupo.store', 'method' => 'POST', 'class' => 'form-horizontal']) !!}

		<div class="form-group">
			{!! Form::label('cod_prf', 'Docente Tutor :', ['class' => 'col-md-2 control-label']) !!}
			<div class="col-md-9">
				{!! Form::select('cod_prf', $docentes, null, ['class' => 'form-control select-docente', 'required', 'data-placeholder' => 'Selecione el docente']) !!}
			</div>
		</div>

		<div class="form-group">
			<div class="col-md-6 col-md-offset-4">
				{!! Form::button('<span class="glyphicon glyphicon-floppy-save"></span> Establecer tutor', ['type' => 'submit', 'class' => 'btn btn-success']) !!}	
				<a href="{{ route('grupo.index') }}" class="btn btn-danger">
					<span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Cancelar
				</a>
			</div>
		</div>
	{!! Form::close() !!}
@endsection

@section('js')
	<script type="text/javascript">
		$('.select-docente').chosen({
			allow_single_deselect: true
		});
	</script>
@endsection 
