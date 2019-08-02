<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="./images/logo-icon.png">
     @stack('styles')
</head>
<body>
	 @yield('content')
	 @stack('scripts')
</body>
</html>