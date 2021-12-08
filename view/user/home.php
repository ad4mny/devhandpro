<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/handcraft-store/db/config.php';
require_once ROOT_URL . '/db/auth.php';
require_once ROOT_URL . '/controller/loginController.php';
require_once ROOT_URL . '/controller/profileController.php';

$profile = new ProfileController();
$auth = new Auth();
$auth->authUser();

if (isset($_GET['act'])) {

	if ($_GET['act'] == 'logout') {

		$logout = new LoginController();
		$logout->logout();
	}
}
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="../bootstrap/upload/favicon.ico">
	<title>E-Shopping HandPro</title>
	<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="../bootstrap/css/all.min.css">
	<link rel="stylesheet" href="../bootstrap/css/badge.css">
	<script type="text/javascript" src="../bootstrap/js/jquery.min.js"></script>
	<script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
	<style type="text/css">
		body,
		html {
			position: relative;
			min-height: 100vh;
		}

		.masthead {
			height: 100vh;
			min-height: 500px;
			background-image: linear-gradient(169deg, rgba(0, 0, 0, 1) 0%, rgba(0, 0, 0, 0.3225665266106442) 50%,
					rgba(0, 0, 0, 1) 100%), url('https://source.unsplash.com/VIxflVJ1BEY/1920x1080');
			background-size: cover;
			background-position: center;
			background-repeat: no-repeat;
		}
	</style>
</head>

<body class="bg-light">

	<!-- Full Page Image Header with Vertically Centered Content -->
	<header class="masthead">
		<!-- Navbar -->
		<nav class="navbar navbar-expand-lg sticky-top bg-light navbar-dark bg-transparent">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarTogglerDemo01">
				<a class="navbar-brand" href="#">HandPro</a>
				<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
					<li class="nav-item active">
						<a class="nav-link" href="#">Home<span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="shop">Shops</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#">About Us</a>
					</li>
				</ul>
				<ul class="navbar-nav ml-auto">
					<li class="nav-item">
						<a href="checkout" class="nav-link"><i class="fas fa-shopping-basket"></i>
							<span class="badge badge-notify" style="font-size:10px;">
								<?php if (isset($_SESSION['cart']) && sizeof($_SESSION['cart']) != 0) {
									echo sizeof($_SESSION['cart']);
								}; ?>
							</span>
						</a>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="fas fa-user"></i> </a>
						<div class="dropdown-menu dropdown-menu-right dropdown-default" aria-labelledby="navbarDropdownMenuLink-333">
							<a class="dropdown-item" href="profile">Profile</a>
							<a class="dropdown-item" href="home?act=logout">Logout</a>
						</div>
					</li>
				</ul>
			</div>
		</nav>

		<div class="container h-100">
			<div class="row h-100 align-items-center">
				<div class="col-12 text-center text-white">
					<h1 class="font-weight-light text-capitalize">Welcome, <?php echo $profile->fetchName($_SESSION['id']); ?>!</h1>
					<p class="lead">Browse over 200+ handcraft now.</p>
					<button type="button" class="btn btn-outline-light rounded-circle" id="arrow_down"><i class="fas fa-chevron-down"></i> </button>
				</div>
			</div>
		</div>
	</header>

	<div class=" m-5" id="scroll_here">
		<div class="row p-3 border-bottom">
			<div class="col">
				<h4><a href="food_delivery" style="text-decoration: none;">Content Header</a></h4>
				<p class="text-muted">Duis ut semper tortor. Pellentesque ultrices lacinia velit, id sodales lectus facilisis sit amet. Donec a sem turpis. Suspendisse potenti. Nullam sed hendrerit tortor. Phasellus eu volutpat tortor. Praesent ac sapien a tellus aliquam iaculis rutrum a nibh. Donec lorem quam, cursus sit amet ullamcorper sagittis, tincidunt non enim. Duis id erat eu ex condimentum sagittis at quis elit. Sed vehicula urna purus, quis tristique nunc vehicula vel. Phasellus egestas rutrum lectus vel porta. Nam fringilla ante eu turpis scelerisque, ac elementum ipsum dictum. Praesent a mollis metus. Quisque varius leo eu ipsum commodo suscipit. Vestibulum porta libero vel felis bibendum, eu viverra justo sagittis. Pellentesque dignissim, tortor rutrum lacinia aliquet, justo velit fringilla quam, mollis feugiat diam velit a nibh.</p>
			</div>
		</div>
	</div>

	<!-- Footer -->
	<footer class="page-footer font-small">
		<div class="container-fluid text-center text-md-left px-5 pt-5 bg-white">
			<div class="row">
				<div class="col-md-6 mt-md-0 mt-3">
					<h5 class="text-uppercase">Footer Content</h5>
					<p>Here you can use rows and columns to organize your footer content.</p>
				</div>
				<hr class="clearfix w-100 d-md-none pb-3">
				<div class="col-md-3 mb-md-0 mb-3">
					<h5 class="text-uppercase">Links</h5>
					<ul class="list-unstyled">
						<li>
							<a href="#!">Link 1</a>
						</li>
						<li>
							<a href="#!">Link 2</a>
						</li>
						<li>
							<a href="#!">Link 3</a>
						</li>
						<li>
							<a href="#!">Link 4</a>
						</li>
					</ul>
				</div>
				<div class="col-md-3 mb-md-0 mb-3">
					<h5 class="text-uppercase">Links</h5>
					<ul class="list-unstyled">
						<li>
							<a href="#!">Link 1</a>
						</li>
						<li>
							<a href="#!">Link 2</a>
						</li>
						<li>
							<a href="#!">Link 3</a>
						</li>
						<li>
							<a href="#!">Link 4</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="footer-copyright text-center py-2 bg-white">
			<small>HandPro &copy; 2020</small>
		</div>
	</footer>

	<script type="text/javascript">
		$("#arrow_down").click(function() {
			$('html,body').animate({
					scrollTop: $("#scroll_here").offset().top
				},
				'slow');
		});
	</script>


</body>

</html>