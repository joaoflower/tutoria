@extends('layouts.report')
@section('title', '[2018-I] Constancia de Tutoría 2018-I')


@section('content')
	<h2>Universidad Nacional del Altiplano Puno</h2>
	<h4>ESCUELA PROFESIONAL DE {{ $docente->car_des }}</h4>
	<h4>TUTORIA UNIVERSITARIA</h4>
	<br><br>

	<p>“AÑO DEL DIÁLOGO Y LA RECONCILIACIÓN NACIONAL”</p>
	<br>
	<h3>CONSTANCIA DE TUTORIA {{ $encusati->id }}-2018-I-UNA-Puno</h3>
	<br>
	<p>El que suscribe, Docente Tutor de la Escuela Profesional de {{ $docente->car_des }} de la Universidad Nacional del Altiplano de Puno</p>
	
	<h3>HACE CONSTAR QUE:</h3>
	
	<p>El Estudiante {{ $estudiante }} ha cumplido con las actividades programadas de tutoría en el semestre académico 2018-I, en concordancia al Reglamento y Normatividad del “Sistema de Tutoría Universitaria”, (aprobado según Resolución Rectoral Nº 1415-2015-R-UNA). </p>
	
	<p>Se expide la presente constancia a solicitud del interesado para los fines pertinentes.</p>
	<br>
	<p>Puno C.U. Julio del 2018</p>
	<br><br><br><br><br><br>
	<p>{{ $docente->paterno }} {{ $docente->materno }} {{ $docente->nombres }}</p>
	<br><br>

	<button id="print_btn" type="button" class="btn btn-success">
		<span class="glyphicon glyphicon-print" aria-hidden="true"></span> Imprimir
	</button>
	<a href="{{ route('encusati.index') }}" class="btn btn-danger">
		<span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Regresar
	</a>

@endsection
@section('js')
	<script type="text/javascript">
		$(document).ready(function () {
	    	$('#print_btn').click(function () {
	        	//$('#pagina').printThis();
	        	window.print();
    			return false;
	    	});
	    });
	</script>
@endsection
