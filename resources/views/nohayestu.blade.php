@extends('layouts.app')

@section('title','Sistema de Tutoría')

@section('aside')
	@include('layouts.include.aside')
@endsection

@section('content')
	<div class="dashboard">
        <div class="dashboard-error">
            <div class="dashboard-header">No tiene tutorados asignados ...!</div>
        </div>
    </div>
@endsection