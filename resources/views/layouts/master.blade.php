<!DOCTYPE html>
<html>
<head>
	<title>@yield('title')</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="{{asset("/css/app.css")}}">
</head>
<body>
	<div class="wrapper">
		<h1>@yield('h1')</h1>
		@yield('content')
		<footer>
			@yield('footer')
		</footer>
		@stack('scripts')
	</div>
</body>
</html>