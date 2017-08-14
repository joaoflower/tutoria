@extends('layouts.app')

@section('title','Información del estudiante')

@section('aside')
	@include('layouts.include.aside')
@endsection

@section('content')
	
	{!! Form::open(['route' => 'infoestu.store', 'method' => 'POST', 'class' => 'form-horizontal']) !!}
		<div class="form-group">
		 	{!! Form::label('num_mat', 'Número de matrícula :', ['class' => 'col-md-4 control-label']) !!}
			<div class="col-md-3">
				{!! Form::text('num_mat', '', ['class' => 'form-control', 'placeholder' => 'Número de matrícula', 'size' => '6', 'maxlength' => '6']) !!}
			</div>
			<div class="col-md-5">
				{!! Form::button('<span class="glyphicon glyphicon-search"></span> Buscar', ['type' => 'button', 'class' => 'btn btn-success', 'id' => 'search_btn']) !!}
			</div>
		</div>
		<div id="informacion">
			
		</div>
	{!! Form::close() !!}
	
@endsection

@section('js')
	<script type="text/javascript">		
		$(window).keydown(function(event){
			if(event.keyCode == 13) {
				event.preventDefault();
		      	return false;
		   	}
		});
		$('#search_btn').click(function () {
			var num_mat = $('#num_mat').val();
			$.get(`infoestu/${num_mat}/viewinfo`, function(response, state) {
				$('#informacion').html(response);
			})
			.done(function() { })
		  	.fail(function( jqXHR, textStatus, errorThrown ) {
		    	console.log(jqXHR);
		    	console.log(textStatus);
		    	console.log(errorThrown);
		  	})
		  	.always(function() { });
		});
	</script>
@endsection