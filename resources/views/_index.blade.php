@extends('layouts.app')

@section('title','Bienvenido')

@section('aside')
	@include('layouts.include.aside')
@endsection

@section('content')

    @if(Auth::user()->type == 'teacher')
    	<div class="alert alert-warning alert-dismissible" role="alert">
    	  	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    	  	<strong>Constancia de Tutoría: </strong> La Constancia de Tutoría estará disponible en el módulo del tutorado. <br>
            El Estudiante es quien genera la Constancia y lo hace firmar por el docente tutor.
    	</div>
    	<div class="dashboard">

            <div class="dashboard-content">
    	        
                <div class="dashboard-header">
    				Universidad Nacional del Altiplano - Puno
                	Sistema de tutoría
                </div>            
                <div class="dashboard-body">            	
                    <p><i class="fa fa-file-pdf-o" aria-hidden="true"></i> {{ link_to_asset('pdfs/CDN_M2.pdf', 'CUESTIONARIO DEL DIAGNOSTICO DE NECESIDADES') }}</p>
                    <p><i class="fa fa-file-pdf-o" aria-hidden="true"></i> {{ link_to_asset('pdfs/DSTG.pdf', 'DISEÑO DE SESION DE TUTORÍA GRUPAL') }}</p>                 
                	<p><i class="fa fa-file-pdf-o" aria-hidden="true"></i> {{ link_to_asset('pdfs/DSTI.pdf', 'DISEÑO DE SESION DE TUTORÍA INDIVIDUAL') }}</p>
                	<p><i class="fa fa-file-pdf-o" aria-hidden="true"></i> {{ link_to_asset('pdfs/ENE.pdf', 'ENCUESTA DE NECESIDADES DE LOS ESTUDIANTES') }}</p>
                    <p><i class="fa fa-file-pdf-o" aria-hidden="true"></i> {{ link_to_asset('pdfs/FRCR.pdf', 'FICHA DE REFERENCIA Y CONTRA REFERENCIA') }}</p>                 
                	<p><i class="fa fa-file-pdf-o" aria-hidden="true"></i> {{ link_to_asset('pdfs/FSI.pdf', 'FICHA DE SEGUIMIENTO INDIVIDUAL') }}</p>
                	<p><i class="fa fa-file-pdf-o" aria-hidden="true"></i> {{ link_to_asset('pdfs/IFSST.pdf', 'INFORME DE FIN DE SEMESTRE DEL SISTEMA DE TUTORÍA') }}</p>
                	<p><i class="fa fa-file-pdf-o" aria-hidden="true"></i> {{ link_to_asset('pdfs/LAS.pdf', 'LISTA DE ASISTENCIA') }}</p>
                	<p><i class="fa fa-file-pdf-o" aria-hidden="true"></i> {{ link_to_asset('pdfs/LIC.pdf', 'LISTA DE COTEJO') }}</p>
                    <p><i class="fa fa-file-pdf-o" aria-hidden="true"></i> {{ link_to_asset('pdfs/PTU.pdf', 'PLAN DE TUTORÍA UNIVERSITARIA') }}</p>                 
                	<p><i class="fa fa-file-pdf-o" aria-hidden="true"></i> {{ link_to_asset('pdfs/REM.pdf', 'REPORTE MENSUAL DE LA IMPLEMENTACIÓN DEL SISTEMA DE TUTORÍA') }}</p>
                    <p><i class="fa fa-file-pdf-o" aria-hidden="true"></i> {{ link_to_asset('pdfs/SMTAU.pdf', 'SISTEMA DE MONITOREO DE LA TUTORÍA') }}</p>                 
                </div>
            </div>        
        </div>
    @endif

    @if(Auth::user()->type == 'student')
        <div class="alert alert-warning alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Constancia de Tutoría: </strong> La Constancia está disponible en la opción <strong>Reportes de Tutoría</strong>. <br>
            Genere la Constancia y hágalo firmar por el docente tutor.
        </div>
        <div class="dashboard">
            <div class="dashboard-content">                
                <div class="dashboard-header">
                    Universidad Nacional del Altiplano - Puno
                    Sistema de tutoría
                </div>            
                <div class="dashboard-body">  
                </div>
            </div>        
        </div>

    @endif
@endsection