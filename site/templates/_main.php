<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Hold &mdash; 100% Free Fully Responsive HTML5 Bootstrap Template by FREEHTML5.co</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Free HTML5 Bootstrap Template by FREEHTML5.CO" />
	<meta name="keywords" content="free html5, free template, free bootstrap, html5, css3, mobile first, responsive" />
	<meta name="author" content="FREEHTML5.CO" />

  <!-- 
	//////////////////////////////////////////////////////

	FREE HTML5 TEMPLATE 
	DESIGNED & DEVELOPED by FREEHTML5.CO
		
	Website: 		http://freehtml5.co/
	Email: 			info@freehtml5.co
	Twitter: 		http://twitter.com/fh5co
	Facebook: 		https://www.facebook.com/fh5co

	//////////////////////////////////////////////////////
	 -->

  	<!-- Facebook and Twitter integration -->
	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
	<link rel="shortcut icon" href="favicon.ico">
	
	<link href='https://fonts.googleapis.com/css?family=Work+Sans:400,300,600,700' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Playfair+Display:400,400italic,700italic,700' rel='stylesheet' type='text/css'>
	<!-- Animate.css -->
	<link rel="stylesheet" href="<?php echo $config->urls->templates; ?>/hold/css/animate.css">
	<!-- Flexslider -->
	<link rel="stylesheet" href="<?php echo $config->urls->templates; ?>/hold/css/flexslider.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="<?php echo $config->urls->templates; ?>/hold/css/icomoon.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="<?php echo $config->urls->templates; ?>/hold/css/bootstrap.css">

	<link rel="stylesheet" id="theme-switch" href="<?php echo $config->urls->templates; ?>/hold/css/style.css">


	<!-- jQuery -->
	<script src="<?php echo $config->urls->templates; ?>/hold/js/jquery.min.js"></script>
	<!-- jQuery Cookie -->
	<script src="<?php echo $config->urls->templates; ?>/hold/js/jquery.cookie.js"></script>
	<script>
	if ( $.cookie('styleCookie') === 'style-light.css') {
		$('html, body').css('background', '#eeeeee');
	} else if ($.cookie('styleCookie') === 'style.css') {
		$('html, body').css('background', '#222222');
	}
	
	</script>
	<!-- jQuery Easing -->
	<script src="<?php echo $config->urls->templates; ?>/hold/js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="<?php echo $config->urls->templates; ?>/hold/js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="<?php echo $config->urls->templates; ?>/hold/js/jquery.waypoints.min.js"></script>
	<!-- Flexslider -->
	<script src="<?php echo $config->urls->templates; ?>/hold/js/jquery.flexslider-min.js"></script>

	<!-- Viewport Units Buggyfill -->
	<script src="<?php echo $config->urls->templates; ?>/hold/js/viewport-units-buggyfill.js"></script>

	<!-- Googgle Map -->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCefOgb1ZWqYtj7raVSmN4PL2WkTrc-KyA&sensor=false"></script>
	<script src="<?php echo $config->urls->templates; ?>/hold/js/google_map.js"></script>

	
	<!-- Main JS  -->
	<script src="<?php echo $config->urls->templates; ?>/hold/js/main.js"></script>

	<!-- Modernizr JS -->
	<script src="<?php echo $config->urls->templates; ?>/hold/js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="<?php echo $config->urls->templates; ?>/hold/js/respond.min.js"></script>
	<![endif]-->

	</head>

	<body>
	
		<!-- Loader -->
		<div class="fh5co-loader"></div>

		<?php echo $content; ?>

		<footer id="fh5co-footer" class="js-fh5co-waypoint">
			<div class="container">
				<div class="row">
					<div class="col-md-12 text-center">
						<p><small>&copy; 2016 Hold. All Rights Reserved. <br> Created by <a href="http://freehtml5.co/" target="_blank">FREEHTML5.co</a> Demo Images: <a href="http://unsplash.com" target="_blank">Unsplash</a> </small> </p>
						<ul class="fh5co-social">
							<li>
								<a href="#"><i class="icon-twitter"></i></a>
							</li>
							<li>
								<a href="#"><i class="icon-facebook"></i></a>
							</li>
							<li>
								<a href="#"><i class="icon-instagram"></i></a>
							</li>
							<li>
								<a href="#"><i class="icon-dribbble"></i></a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</footer>
		
	</body>
</html>