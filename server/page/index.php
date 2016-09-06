<!DOCTYPE html>
<html ng-app="Snack4me">
<head>
	<meta charset="utf-8" />

	<title>Snack4me</title>
	<meta name="description" content="">
	<meta name="author" content="snack4me">
	<meta name="HandheldFriendly" content="true">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<!-- Import CSS -->
	<noscript>
		<link rel="stylesheet" href="css/skel.css" />
		<link rel="stylesheet" href="css/style.css" />
	</noscript>
</head>

<body id="top" ng-controller="Snack4meCtrl">

	<header id="header" class="skel-layers-fixed" ng-controller="HeaderCtrl">
		<div class="logo">
			<h1 id="logo"><a href="#/"><img src="images/logo.png" width="150px" title="Snack4me" /></a></h1>
		</div>
	</header>

	<div ng-view class="animate" autoscroll="true"></div>

	<script src="js/angular.min.js"></script>
	<script src="js/angular-route.min.js"></script>
	<script src="js/angular-sanitize.min.js"></script>
	<script src="js/angular-cookies.min.js"></script>
	<script src="js/angular-animate.min.js"></script>
	<script src="js/ngFacebook.js"></script>
	<script src="js/ngGooglePlus.js"></script>
	<script src="js/app.js"></script>
	<script src="js/services/auth.js"></script>
	<script src="js/controllers/controllers.js"></script>
	<script src="js/jquery.min.js"></script>
	<script src="js/jquery.price_format.js"></script>
	<script src="js/skel.min.js"></script>
	<script src="js/skel-layers.min.js"></script>
	<script src="js/init.js"></script>
</body>
</html>
