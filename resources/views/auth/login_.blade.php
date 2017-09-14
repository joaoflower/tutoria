@extends('layouts.sign')
@section('title','Login')

@section('content')

    {!! Form::open(['route' => 'auth.signin', 'method' => 'POST', 'class' => 'form-horizontal']) !!}        

        <div class="form-group {{ $errors->has('username') ? ' has-error' : '' }}">
            {!! Form::label('username', 'Usuario :', ['class' => 'col-md-4 control-label']) !!}
            <div class="col-md-6">
                {!! Form::text('username', old('username'), ['class' => 'form-control', 'placeholder' => 'Usuario']) !!}
                @if ($errors->has('username'))
                    <span class="help-block">
                        {{ $errors->first('username') }}
                    </span>
                @endif
            </div>            
        </div>
        <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
            {!! Form::label('password', 'Contraseña :', ['class' => 'col-md-4 control-label']) !!}
            <div class="col-md-6">
                {!! Form::password('password', ['class' => 'form-control', 'placeholder' => '*********']) !!}
                @if ($errors->has('password'))
                    <span class="help-block">
                        {{ $errors->first('password') }}
                    </span>
                @endif
            </div>            
        </div>

        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                {!! Form::button('<span class="glyphicon glyphicon-log-in"></span> Acceder', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
            </div>            
        </div>

    {!! Form::close() !!}

@endsection
