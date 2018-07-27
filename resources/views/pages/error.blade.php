@extends('../layouts.master')
@section('title', "Internal Server error")
@section('head_title', "Error Server")

@section('content')
	<?php dump( $error )?> 
	<p>
		<a href="index">Retour</a>
	</p>
@stop