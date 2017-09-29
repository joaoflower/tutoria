<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>@yield('title', 'Dashboard') | Sistema de Tutoría</title>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
	<link rel="icon" type="image/png" href="{{ asset('favicon.png') }}" />

@yield('css0')
	<link rel="stylesheet" href="{{ asset('assets/jquery-ui/css/jquery-ui.min.css') }}">

	<link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap-reset.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/animate/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/font-awesome/css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/ionicon/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/velonic/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/velonic/css/helper.css') }}">
@yield('css1')
    <link rel="stylesheet" href="{{ asset('assets/datatables/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/summernote/css/summernote.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/chosen/css/chosen.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/sweet-alert/css/sweet-alert.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/tutoria17/css/tutoria.css') }}">
@yield('css')
</head>
<body>

<aside class="left-panel">
	@include('layouts.include.aside17')
</aside>
<section class="content">
	<header class="top-head container-fluid">
		@include('layouts.include.nav17')
	</header>
	<div class="wraper container-fluid">
		@include('flash::message')
		@yield('content')
	</div>
	<footer class="footer">
        2017 © Oficina de Tutoria Universitaria - UNA - Puno
    </footer>
</section>

<script src="{{ asset('assets/jquery/js/jquery.min.js') }}"></script>
@yield('js0')
<script src="{{ asset('assets/jquery-ui/js/jquery-ui.min.js') }}"></script>

<script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/pace/js/pace.min.js') }}"></script>
<script src="{{ asset('assets/wow/js/wow.min.js') }}"></script>
<script src="{{ asset('assets/jquery/js/jquery.nicescroll.min.js') }}"></script>
<script src="{{ asset('assets/velonic/js/velonic.js') }}"></script>
@yield('js1')
<script src="{{ asset('assets/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/summernote/js/summernote.min.js') }}"></script>
<script src="{{ asset('assets/summernote/js/summernote-es-ES.min.js') }}"></script>
<script src="{{ asset('assets/chosen/js/chosen.jquery.min.js') }}"></script>
<script src="{{ asset('assets/sweet-alert/js/sweet-alert.min.js') }}"></script>

<script src="{{ asset('assets/tutoria17/js/tutoria.js') }}"></script>
@yield('js')

</body>
</html>
