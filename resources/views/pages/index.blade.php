@extends('../layouts/master')

@section('title', 'URL Shortener')

@section('h1','The best URL Shortener out there !')

@section('content')
	
	<form method="POST">
		{{csrf_field() }} {{-- protection contre les faill csrf--}}
		{{-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> --}}
		<input type="text" name="url" placeholder="Enter your original URL here">
		<input type="submit" name="Shorten URL">
	</form>

@stop

