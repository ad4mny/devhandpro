<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/handcraft-store/db/config.php';
require_once ROOT_URL . '/db/auth.php';
require_once ROOT_URL . '/controller/loginController.php';
require_once ROOT_URL . '/controller/profileController.php';
require_once ROOT_URL . '/controller/paymentController.php';

$profile = new ProfileController();
$order = new PaymentController();
$auth = new Auth();
$auth->authUser();

$data = $order->viewAllOrder();

if (isset($_POST['update'])) {
	$update = new LoginController();
	$update->updateProfile($_SESSION['id']);
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
			height: 25vh;
			background-image: linear-gradient(90deg, rgba(2, 0, 36, 1) 0%, rgba(255, 105, 128, 0.40379901960784315) 60%,
					rgba(255, 105, 126, 1) 100%), url('https://source.unsplash.com/rlbG0p_nQOU/1920x1080');
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
					<li class="nav-item ">
						<a class="nav-link" href="home">Home</a>
					</li>
					<li class="nav-item ">
						<a class="nav-link" href="shop">Shops</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#">About Us</a>
					</li>
				</ul>
				<ul class="navbar-nav ml-auto">
					<a href="checkout" class="nav-link"><i class="fas fa-shopping-basket"></i>
						<span class="badge badge-notify" style="font-size:10px;">
							<?php if (isset($_SESSION['cart']) && sizeof($_SESSION['cart']) != 0) {
								echo sizeof($_SESSION['cart']);
							}; ?>
						</span>
					</a>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle active" id="navbarDropdownMenuLink-333" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user"></i> </a>
						<div class="dropdown-menu dropdown-menu-right dropdown-default" aria-labelledby="navbarDropdownMenuLink-333">
							<a class="dropdown-item" href="#">Profile</a>
							<a class="dropdown-item" href="home?act=logout">Logout</a>
						</div>
					</li>
				</ul>
			</div>
		</nav>

		<div class="container h-100">
			<div class="row h-100 align-items-center">
				<div class="col-12 text-white">
					<h1 class="font-weight-lighter">Profile Dashboard</h1>
				</div>
			</div>
		</div>
	</header>

	<!-- Alert -->
	<div id="alert" class="w-50 position-absolute" style="z-index: 1; top:5%; left: 25%;"></div>

	<!-- Content -->
	<div class="p-5 ">
		<div class="row">

			<div class="col-3" id="profile_display">
				<h4 class="pb-3 border-bottom text-capitalize">Hi, <?php echo $profile->fetchName($_SESSION['id']); ?>.</h4>
				<div class="form-group font-weight-light">
					<div class="mb-1 "><i class="fas fa-user"></i> Full Name</div>
					<div class="text-muted  text-capitalize"> <?php echo $profile->fetchName($_SESSION['id']); ?></div>
				</div>
				<div class="form-group font-weight-light">
					<div class="mb-1 "><i class="fas fa-map-marked-alt"></i> Address</div>
					<div class="text-muted  text-capitalize"> <?php echo $profile->fetchLocation($_SESSION['id']); ?></div>
				</div>
				<div class="form-group font-weight-light">
					<div class="mb-1 "><i class="fas fa-mobile-alt"></i> Phone Number</div>
					<div class="text-muted"> <?php echo $profile->fetchPhone($_SESSION['id']); ?></div>
				</div>
				<div class="form-group font-weight-light">
					<a href="profile?act=update"><small>Edit profile</small></a>
				</div>
			</div>

			<div class="col-3" id="update_display" style="display: none;">
				<form action="" method="POST">
					<h4 class="pb-3 border-bottom text-capitalize">Hi, <?php echo $profile->fetchName($_SESSION['id']); ?>.</h4>
					<div class="form-group font-weight-light">
						<div class="mb-1 "><i class="fas fa-user"></i> Full Name</div>
						<div class="text-muted  text-capitalize"> </div>
						<div class="input-group">
							<input type="text" class="form-control" name="fname" placeholder="First Name" value="<?php echo $profile->fetchFirstName($_SESSION['id']); ?>" required>
							<input type="text" class="form-control" name="lname" placeholder="Last Name" value="<?php echo $profile->fetchLastName($_SESSION['id']); ?>" required>
						</div>
					</div>
					<div class="form-group font-weight-light">
						<div class="mb-1 "><i class="fas fa-map-marked-alt"></i> Address</div>
						<textarea class="form-control" name="address" placeholder="Address" rows="3" required><?php echo $profile->fetchLocation($_SESSION['id']); ?></textarea>
					</div>
					<div class="form-group font-weight-light">
						<div class="mb-1 "><i class="fas fa-mobile-alt"></i> Phone Number</div>
						<input type="text" class="form-control" name="phone" placeholder="Phone Number" value="<?php echo $profile->fetchPhone($_SESSION['id']); ?>" required>
					</div>
					<div class="form-group font-weight-light">
						<input type="hidden" name="update">
						<button type="submit" class="form-control btn btn-primary">Update Profile <i class="fas fa-chevron-right"></i></button>
					</div>
				</form>
			</div>

			<div class="col border-left">
				<h4 class="pb-3 border-bottom font-weight-light">Order History</h4>
				<div class="p-2">
					<?php
					if ($data != null) {
						foreach ($data as $row) {
							echo '<div class="row shadow-sm mb-1 bg-white rounded">';
							if ($row['product_image'] != null) {

								echo '<div class="col-2 "><img class="img-fluid" src="../../' . $row['product_image'] . '" alt="Image Unavailable"></div>';
							} else {

								echo '<div class="col-2 "><img class="img-fluid" src="https://dummyimage.com/640x360/f0f0f0/aaa" alt="Image Unavailable"></div>';
							}
							echo '<div class="col-8  p-3">' . $row['product_name'] .
								'<br><small class="text-muted">' . $row['product_desc'] . '</small></div>';
							echo '<div class="col-2  p-3 text-muted font-italic"><small >' . $row['od_status'] . '</small>
							<br><small class="text-muted">' . $row['od_product_qty'] . ' Unit(s)</small></div>';
							echo '</div>';
						}
					} else {
						echo "<p class=''> No history available yet.</p>";
					}
					?>
				</div>
			</div>
		</div>
	</div>

	<!-- Footer -->
	<footer class="page-footer font-small blue w-100" style="position: absolute; bottom: 0;">
		<div class="footer-copyright text-center py-2 bg-white">
			<small>HandPro &copy; 2020</small>
		</div>
	</footer>

	<script type="text/javascript">
		$(document).ready(function() {

			var url_string = window.location.href;
			var url = new URL(url_string);
			var action = url.searchParams.get("act");

			if (action === 'update') {
				$("#update_display").show();
				$("#profile_display").hide();

			}

		});
	</script>

	<script type="text/javascript" src="../bootstrap/js/app.js"></script>

</body>

</html>