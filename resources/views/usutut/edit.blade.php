@extends('layouts.app')
@section('title', 'Editar Coordinador de tutoría')

@section('aside')
	@include('layouts.include.aside')
@endsection

@section('content')
	{!! Form::open(['route' => ['usutut.update', $usuhead], 'method' => 'PUT', 'class' => 'form-horizontal']) !!}

		<div class="form-group">
			{!! Form::label('cod_car', 'Escuela :', ['class' => 'col-md-2 control-label']) !!}
			<div class="col-md-9">
				<p class="form-control-static">{{ $usuhead->car_des }}</p>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('codigo', 'Docente :', ['class' => 'col-md-2 control-label']) !!}
			<div class="col-md-9">
				<p class="form-control-static">{{ $usuhead->name }}</p>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('email', 'E-mail :', ['class' => 'col-md-2 control-label']) !!}
			<div class="col-md-9">
				{!! Form::email('email', $usuhead->email, ['class' => 'form-control', 'placeholder' => 'user@mail.com', 'required']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('username', 'Usuario :', ['class' => 'col-md-2 control-label']) !!}
			<div class="col-md-9">
				{!! Form::text('username', $usuhead->username, ['class' => 'form-control', 'placeholder' => 'Usuario', 'required']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('password', 'Contraseña :', ['class' => 'col-md-2 control-label']) !!}
			<div class="col-md-9">
				{!! Form::password('password', ['class' => 'form-control', 'placeholder' => '**********', 'required']) !!}
			</div>
		</div>

		<div class="form-group">
			<div class="col-md-6 col-md-offset-4">
				{!! Form::button('<span class="glyphicon glyphicon-floppy-save"></span> Editar Coordinador', ['type' => 'submit', 'class' => 'btn btn-success']) !!}	
				<a href="{{ route('usutut.index') }}" class="btn btn-danger">
					<span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Cancelar
				</a>
			</div>
		</div>
	{!! Form::close() !!}
@endsection
