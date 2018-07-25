@extends('../layouts/master')
@section('title', 'Url Shortened')
@section('h1', "This is your URL shortened")

@section('content')
	{{-- {{ config("services.ses.region")}} --}}
	<a target="_blank" href="{{ config("app.url")."/".$urlExist->shortened_url}}">{{ config("app.url")."/".$urlExist->shortened_url}}</a>
@stop