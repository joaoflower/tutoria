@extends('layouts.app')

@section('title','Sistema de Tutoría')

@section('aside')
	@include('layouts.include.aside')
@endsection

@section('content')
	<div class="dashboard">
        <div class="dashboard-content">
            <div class="dashboard-error">No tiene Tutor asignado ...!</div>
        </div>
    </div>
@endsection