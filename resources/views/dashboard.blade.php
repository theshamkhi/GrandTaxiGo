<!doctype html>
<html class="no-js" lang="en">

    <head>
        <!-- meta data -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

        <!--font-family-->
		<link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

		<link href="https://fonts.googleapis.com/css?family=Rufina:400,700" rel="stylesheet">
        
        <!-- title of site -->
        <title>GrandTaxiGo</title>

        <!-- For favicon png -->
		<link rel="shortcut icon" type="image/icon" href="{{ asset('logo/favicon.png') }}"/>
       
        <!--font-awesome.min.css-->
        <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">

        <!--linear icon css-->
		<link rel="stylesheet" href="{{ asset('css/linearicons.css') }}">

        <!--flaticon.css-->
		<link rel="stylesheet" href="{{ asset('css/flaticon.css') }}">

		<!--animate.css-->
        <link rel="stylesheet" href="{{ asset('css/animate.css') }}">

        <!--owl.carousel.css-->
        <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
		<link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
		
        <!--bootstrap.min.css-->
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
		
		<!-- bootsnav -->
		<link rel="stylesheet" href="{{ asset('css/bootsnav.css') }}" >	
        
        <!--style.css-->
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        
        <!--responsive.css-->
        <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
        
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		
        <!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>
	
	<body>
		<!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->
	
		<!--welcome-hero start -->
		<section id="home" class="welcome-hero">

			<!-- top-area Start -->
			<div class="top-area">
				<div class="header-area">
					<!-- Start Navigation -->
				    <nav class="navbar navbar-default bootsnav  navbar-sticky navbar-scrollspy"  data-minus-value-desktop="70" data-minus-value-mobile="55" data-speed="1000">

				        <div class="container">

				            <!-- Start Header Navigation -->
				            <div class="navbar-header">
				                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
				                    <i class="fa fa-bars"></i>
				                </button>
				                <a class="navbar-brand" href="index.html">GrandTaxiGo<span></span></a>

				            </div><!--/.navbar-header-->
				            <!-- End Header Navigation -->

				            <!-- Collect the nav links, forms, and other content for toggling -->
							<div class="collapse navbar-collapse menu-ui-design" id="navbar-menu">
								<ul class="nav navbar-nav navbar-right" data-in="fadeInDown" data-out="fadeOutUp">
									<li class="scroll active"><a href="#home">Home</a></li>
									<li class="scroll"><a href="#service">Service</a></li>
									<li class="scroll">
										<a href="{{ route('reservations.index') }}">Reservations</a>
									</li>
									<li class="scroll"><a href="#contact">Available Drivers</a></li>
									<li class="scroll">
										<form method="POST" action="{{ route('logout') }}">
											@csrf
											<button type="submit" style="background: none; border: none; cursor: pointer; color: inherit; padding: 0; font: inherit;">
												{{ __('LOG OUT') }}
											</button>
										</form>
									</li>
								</ul><!--/.nav -->
							</div>
				        </div><!--/.container-->
				    </nav><!--/nav-->
				    <!-- End Navigation -->
				</div><!--/.header-area-->
			    <div class="clearfix"></div>

			</div><!-- /.top-area-->
			<!-- top-area End -->

			<div class="container">
				<div class="welcome-hero-txt">
					<h2>Effortless booking with GrandTaxiGo</h2>
					<p>
						Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore   magna aliqua. 
					</p>
					<button class="welcome-btn" onclick="window.location.href='#'">contact us</button>
				</div>
			</div>

		</section><!--/.welcome-hero-->

		<!--service start -->
		<section id="service" class="service">
			<div class="container">
				<div class="section-header">
					<p>checkout <span>the</span> available drivers</p>
					<h2>available drivers</h2>
				</div>
				<div class="featured-cars-content">
					<div class="row">
						@foreach ($availableDrivers as $driver)
							<div class="col-md-4 col-sm-6">
								<div class="single-service-item">
									<div class="single-service-icon">
										<img src="{{ asset('storage/' . $driver->photo) }}" alt="{{ $driver->name }}">
									</div>
									<h2>From: {{ $driver->From }}</h2>
									<h2>From: {{ $driver->To }}</h2>
									<h2>{{ $driver->name }}</h2>
									<h4>{{ $driver->phone }}</h4>
									<a href="{{ route('reservations.create', ['driverID' => $driver->driverID]) }}" class="btn btn-primary">Reserve</a>
								</div>
							</div>
						@endforeach
					</div>
				</div>
			</div><!--/.container-->
		</section><!--/.service-->
		
		<!-- Include all js compiled plugins (below), or include individual files as needed -->

		<script src="{{ asset('/js/jquery.js') }}"></script>
        
        <!--modernizr.min.js-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
		
		<!--bootstrap.min.js-->
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
		
		<!-- bootsnav js -->
		<script src="{{ asset('js/bootsnav.js') }}"></script>

		<!--owl.carousel.js-->
        <script src="{{ asset('js/owl.carousel.min.js') }}"></script>

		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>

        <!--Custom JS-->
        <script src="{{ asset('js/custom.js') }}"></script>
        
    </body>
	
</html>




