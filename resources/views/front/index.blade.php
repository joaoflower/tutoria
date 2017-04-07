<!doctype html>
<html class="no-js" lang="">
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Tutoría Universitaria - Universidad Nacional del Altiplano</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="icon" type="image/png" href="{{ asset('favicon.png') }}" />
	<link rel="stylesheet" href="{{ asset('web/assets/css/bootstrap.min.css') }}">
	<link rel="stylesheet/less" href="{{ asset('web/assets/css/less/font-awesome.less') }}">
	<link rel="stylesheet" href="{{ asset('web/assets/css/magnific-popup.css') }}">
	<link rel="stylesheet/less" href="{{ asset('web/assets/css/style.less') }}">
	<link rel="stylesheet/less" href="{{ asset('web/assets/css/responsive.less') }}">
	<style type="text/css">
		header .navbar-default .navbar-brand {
		    text-transform: none;
		}
		.main-banner .banner-title {
			text-transform: inherit;
		    padding: 15% 0 0;
		}
	</style>

	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Raleway:300,400,600,700,800' rel='stylesheet' type='text/css'>


	<script src="{{ asset('web/assets/js/less.min.js') }}"></script>
</head>

<body>

	<div id="page-top" class="page-top"></div><!-- /#page-top -->

	<header id="header" class="header">

		<nav class="navbar navbar-default">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-menu" aria-expanded="false">
						<i class="fa fa-bars"></i>
					</button>
					<a class="navbar-brand" href="./">tutor Un@p</a>
				</div><!-- /.navbar-header -->

				<div id="main-menu" class="main-menu collapse navbar-collapse pull-right">
					<ul class="nav navbar-nav">
						<li class="active"><a href="#page-top">Inicio</a></li>
						<li><a href="#about">Tutoría</a></li>
						
					</ul>
				</div><!-- /#main-menu -->
			</div><!-- /.container -->
		</nav>
	</header><!-- /header -->



	<section id="main-banner" class="main-banner text-center">
		<div class="container">
			<h2 class="banner-title">Tutoría Universitaria</h2><!-- /.banner-title -->

			<p class="description">
				Ponemos a disposición de toda la comunidad universitaria, la primera versión de la página Web de Tutoría Universitaria, dentro de su contenido presentaremos diferentes documentos que son fruto del trabajo de personas que colaboraron y participaron en la implementación del Sistema de Tutoría en la UNA Puno.
			</p><!-- /.description -->

			<div class="btn-container">
				<a class="btn" href="{{ route('index') }}">Ingresar al Sistema de Tutoría</a>
			</div><!-- /.btn-container -->

			<div class="next-section">
				<button id="go-to-next" class="go-to-next"><i class="fa fa-angle-double-down faa-bounce animated"></i></button>
			</div>
		</div><!-- /.container -->
	</section><!-- /#main-banner -->



	<section id="about" class="about text-center">
		<div class="section-padding">
			<div class="container">
				<div class="row">
					<div class="section-top">
						<h2 class="section-title">Tutoría Universitaria</h2><!-- /.section-title -->
						<p class="description">La Tutoría Universitaria es el proceso de acompañamiento de los estudiantes, desde su ingreso a una Escuela Profesional de la Universidad Nacional del Altiplano, hasta la culminación de sus estudios, obtención del grado de bachiller y título profesional. Este acompañamiento se realizará mediante acciones de orientación e información bajo distintas modalidades de intervención, según la naturaleza del tema, características del estudiante, grupo de estudiantes a atender y los recursos con los que se cuenta.</p><!-- /.description -->
					</div><!-- /.section-top -->
					<div class="section-details">
						<div class="col-sm-4">
							<div class="item">
								<div class="item-icon"><i class="fa fa-graduation-cap"></i></div><!-- /.item-icon -->
								<h3 class="item-title">Docente Tutor</h3><!-- /.item-title -->
								<p class="description">Son Tutores los docentes que desarrollen labores académicas con los estudiantes universitarios en su respectiva Escuela Profesional, independientemente de su especialidad y carga académica.</p><!-- /.description -->
							</div><!-- /.item -->
						</div>
						<div class="col-sm-4">
							<div class="item">
								<div class="item-icon"><i class="fa fa-child"></i></div><!-- /.item-icon -->
								<h3 class="item-title">Tutorado</h3><!-- /.item-title -->
								<p class="description">Tutorado es el estudiante matriculado en la UNA – Puno, quien voluntariamente acepta, en formato de compromiso, tener un docente tutor.</p><!-- /.description -->
							</div><!-- /.item -->
						</div>
						<div class="col-sm-4">
							<div class="item">
								<div class="item-icon"><i class="fa fa-university"></i></div><!-- /.item-icon -->
								<h3 class="item-title">OTU</h3><!-- /.item-title -->
								<p class="description">El Sistema de Tutoría en la Universidad Nacional del Altiplano tiene como finalidad orientar a los estudiantes en los aspectos personal y académico durante su proceso de formación profesional.</p><!-- /.description -->
							</div><!-- /.item -->
						</div>
					</div><!-- /.section-details -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</div><!-- /.section-padding -->
	</section><!-- /#about -->


	<section id="google-map" class="google-map">
		<div id="googleMaps" class="google-map-container"></div>
	</section><!-- /#google-map -->



	<footer id="footer-widget" class="footer-widget text-center">
		<div class="container">
			
			<div class="copyright">
				© <a href="#">OFICINA DE TUTORÍA UNIVERSITARIA</a>  2016 
			</div><!-- /.copyright -->
		</div><!-- /.container -->
	</footer><!-- /footer -->


	<div id="scroll-to-top" class="scroll-to-top">
		<i class="fa fa-angle-double-up"></i>    
	</div><!-- /#scroll-to-top -->




	<script>window.jQuery || document.write('<script src="{{ asset('web/assets/js/jquery-1.11.3.min.js') }}"><\/script>')</script>
	<script src="{{ asset('web/assets/js/plugins.js') }}"></script>
	<script src="http://maps.google.com/maps/api/js?sensor=true"></script>
	<script src="{{ asset('web/assets/js/gmap3.js') }}"></script>
	<script src="{{ asset('web/assets/js/main.js') }}"></script>


	<script type="text/javascript">

		jQuery(document).ready(function($) {

			"use strict";

			jQuery('#main-menu').onePageNav({
				currentClass: 'current',
				changeHash: false,
				scrollSpeed: 750,
				scrollThreshold: 0.5,
				filter: '',
				easing: 'swing',
				begin: function() {
				},
				end: function() {
				},
				scrollChange: function($currentListItem) {

				}
			});

			jQuery('.image-popup-vertical-fit').magnificPopup({
				type: 'image',
				gallery:{
					enabled:true
				}
			});
		});


		function isMobile() { 
			return ('ontouchstart' in document.documentElement);
		}

		function init_gmap() {
			if ( typeof google == 'undefined' ) return;
			var options = {
				center: [-15.823621, -70.017076],
				zoom: 15,
				mapTypeControl: true,
				mapTypeControlOptions: {
					style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
				},
				navigationControl: true,
				scrollwheel: false,
				streetViewControl: true
			}

			if (isMobile()) {
				options.draggable = false;
			}

			jQuery('#googleMaps').gmap3({
				map: {
					options: options
				},
				marker: {
					latLng: [-15.823621, -70.017076],
					options: { icon: '{{ asset('web/images/mapicon.png') }}' }
				}
			});
		}

		init_gmap();
	</script>
</body>
</html>
