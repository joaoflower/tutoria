@extends('layouts.app')

@section('title','Bienvenido')

@section('aside')
	@include('layouts.include.aside')
@endsection

@section('content')
	<div class="dashboard">
        <div class="dashboard-content">
            <div class="dashboard-header">Universidad Nacional del Altiplano - Puno</div>
            <img src="images/tutoria.png" alt="">
            <div class="dashboard-body">Sistema de tutoría</div>
        </div>
    </div>
@endsection