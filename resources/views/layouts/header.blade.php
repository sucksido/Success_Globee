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
			<div class="header">
				<div class="navigation__header col-xs-2">
					<div class="navigation__logo">
						<img src="{{ asset('images/globee.png') }} ">
						<span></span>
					</div>
				</div>	

				<!--main header -->
				<div class="main__header">
					<div class="main__headernavleft">
						<div id="toggleNav" class="main__closenav icon-chevron-thin-left"></div>

					</div>
					<h1 class="main__title"> Welcome back {{Auth::user()->firstname}}. Your default currency is {{Auth::user()->currency}} </h1>
					<div class="main__headernavright">

						<div class="main__icon">
							<a href="{{ url('/logout')}}" class="button icon-exit"
							 onclick="event.preventDefault();
		                                                     document.getElementById('logout-form').submit();">
		                    </a>
		                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
		                        {{ csrf_field() }}
		                    </form>	
						</div>

					</div>
				</div>
				<!--//main header -->
			</div>