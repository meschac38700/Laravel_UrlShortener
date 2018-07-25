<!DOCTYPE html>
<html>
<head>
	<title>@yield('title')</title>
	<meta charset="utf-8">
</head>
<body>
	<h1>@yield('h1')</h1>
	@yield('content')
	<footer>
		@yield('footer')
	</footer>
	@stack('scripts')
</body>
</html>