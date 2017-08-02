<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>@yield('title', 'Dashboard') | Sistema de Tutoria</title>
	<link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
	<link rel="icon" type="image/png" href="{{ asset('favicon.png') }}" />
	<link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('plugins/chosen/chosen.css') }}">
	<link rel="stylesheet" href="{{ asset('plugins/trumbowyg/ui/trumbowyg.min.css') }}">
	<link rel="stylesheet" href="{{ asset('plugins/font-awesome/css/font-awesome.min.css') }}">
	<link rel="stylesheet" href="{{ asset('plugins/jquery-ui/css/jquery-ui.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/menu.css') }}">
	<link rel="stylesheet" href="{{ asset('css/main.css') }}">

</head>
<body class="my-body">
<div class="container">

	<div class="row text-center">
	@yield('content')
	</div>	

</div>

<script src="{{ asset('plugins/jquery/js/jquery-2.2.2.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-ui/js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('plugins/chosen/chosen.jquery.js') }}"></script>
<script src="{{ asset('plugins/trumbowyg/trumbowyg.min.js') }}"></script>
<script src="{{ asset('js/menu.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>

@yield('js')
</body>
</html>