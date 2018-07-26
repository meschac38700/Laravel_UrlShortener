@extends('../layouts.master')
@section('title', "Internal Server error")
@section('head_title', "Error Server")

@section('content')
	{{ json_encode( $error ) }}
@stop