<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<title>Login | Sistema de Tutoría</title>	
	<link rel="icon" type="image/png" href="{{ asset('favicon.png') }}" />
	<link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap-reset.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/animate/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/font-awesome/css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/tutoria17/css/login.css') }}">
</head>
<body>
	<div class="background">
		<div class="backgroundImage"></div>
		<div class="background-overlay"></div>
	</div>
	<div class="outer">
		<div class="middle">
			<div class="inner">
				
				<div class="logo">					
					<img src="http://www.unap.edu.pe/web4/sites/all/themes/webunap/img/imgweb/icons/tutoria.png">
				</div>
				{!! Form::open(['route' => 'auth.signin', 'method' => 'POST']) !!} 
					<div class="form-group {{ $errors->has('username') ? ' has-error' : '' }}">                                
                        {!! Form::text('username', old('username'), ['class' => 'form-control', 'placeholder' => 'Usuario', 'autofocus']) !!}
		                @if ($errors->has('username'))
		                    <span class="help-block">
		                        {{ $errors->first('username') }}
		                    </span>
		                @endif
	                </div>
	                <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">                                
                        {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Contraseña']) !!}
		                @if ($errors->has('password'))
		                    <span class="help-block">
		                        {{ $errors->first('password') }}
		                    </span>
		                @endif
	                </div>
	                <div class="form-group">
	                	{!! Form::button('<i class="fa fa-sign-in"></i> <span>Iniciar sesión</span>', ['type' => 'submit', 'class' => 'btn btn-primary btn-rounded btn-custom btn-lg m-b-5']) !!}
	                </div>	                
	        	{!! Form::close() !!}
			</div>
		</div>
	</div>
	<div class="footer">
		<div class="footerNode">
			<span>2017 © Oficina de Tutoria Universitaria - UNA - Puno </span>
		</div>
	</div>
</body>
</html>
