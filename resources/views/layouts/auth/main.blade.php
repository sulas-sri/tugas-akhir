<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login - {{ config('app.name') }}</title>
	<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
	<link rel="stylesheet" href="{{ asset('vendors/bootstrap-icons/bootstrap-icons.css') }}">
	<link rel="stylesheet" href="{{ asset('css/app.css') }}">
	<link rel="stylesheet" href="{{ asset('css/pages/auth.css') }}">
</head>

<body class="vh-100 authincation-content">
	<style>
			.invalid-feedback{
					font-size: 14px;
			}
			.authincation-content {
			background: url("{{ URL::to('images/picture-school.png') }}");
			background-size: 100% auto;
			background-position: center;
			background-attachment: fixed;

			.bg-guttters {
			background-color: #ECFDF3;
			height: 75vh;
			width: 75vh;
			}

			.bg-log {
			background-color: #125488;
			}
	</style>
	<div class="authincation h-100">
			<div class="container h-100">
					<!-- Main Wrapper -->
					@yield('content')
					<!-- /Main Wrapper -->
			</div>
	</div>
<!-- Required vendors -->
<script src="{{ URL::to('assets/vendor/global/global.min.js') }}"></script>
<script src="{{ URL::to('assets/js/custom.min.js') }}"></script>
<script src="{{ URL::to('assets/js/dlabnav-init.js') }}"></script>
<script src="{{ URL::to('assets/js/styleSwitcher.js') }}"></script>
@yield('script')
</body>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"
	integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

@stack('js')

</html>
