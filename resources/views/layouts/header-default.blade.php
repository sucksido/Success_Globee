<!DOCTYPE html>
<html class="no-js" >
	<head>

		<!-- Basic -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=11" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		
		
		 <meta name="viewport" content="width=device-width, initial-scale=1">

	    <!-- CSRF Token -->
	    <meta name="csrf-token" content="{{ csrf_token() }}">

	    <title>{{ config('app.name', 'Laravel') }}</title>

	    <!-- Styles -->
	    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

	    <!-- Scripts -->
	    <script>
	        window.Laravel = <?php echo json_encode([
	            'csrfToken' => csrf_token(),
	        ]); ?>
	    </script>
	</head>
	<body> 
		<div class="wrapper" id="app">
			<div class="header default">
				<div class="navigation__header white col-xs-2">
					<div class="navigation__logo">
						<img src="{{ asset('images/globee.png') }} ">
						<span></span>
					</div>
				</div>	

				
			</div>