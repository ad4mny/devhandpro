<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/devhandpro/db/config.php';
require_once ROOT_URL . '/db/auth.php';
require_once ROOT_URL . '/controller/shopController.php';
require_once ROOT_URL . '/controller/profileController.php';

$profile = new ProfileController();
$browse = new ShopController();
$data = $browse->shopBrowse();
$auth = new Auth();
$auth->authUser();

if (isset($_GET['search'])) {
	$data = $browse->shopSearch($_GET['search']);
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

		.card-columns {

				column-count: 4;
		}

		.masthead {
			height: 25vh;
			background-image: linear-gradient(90deg, rgba(2, 0, 36, 1) 0%, rgba(255, 201, 0, 0.4009978991596639) 60%,
					rgba(255, 201, 0, 1) 100%), url('https://source.unsplash.com/rlbG0p_nQOU/1920x1080');
			background-size: cover;
			background-position: center;
			background-repeat: no-repeat;
		}
	</style>
</head>

<body class="bg-light">

	<!-- Full Page Image Header with Vertically Centered Content -->
	<header class="masthead">
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
					<li class="nav-item active">
						<a class="nav-link" href="#">Shops</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#">About Us</a>
					</li>
				</ul>
				<ul class="navbar-nav ml-auto">
					<li class="nav-item">
						<a href="checkout" class="nav-link "><i class="fas fa-shopping-basket"></i>
							<span class="badge badge-notify" style="font-size:10px;">
								<?php
								if (isset($_SESSION['cart']) && sizeof($_SESSION['cart']) != 0) {
									echo sizeof($_SESSION['cart']);
								};
								?>
							</span>
						</a>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user"></i> </a>
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
				<div class="col-12 text-white">
					<h1 class="font-weight-lighter">Our specialised handcrafted souvenir and items. </h1>
				</div>
			</div>
		</div>
	</header>

	<!-- Content -->
	<div class="p-5">
		<div class="row">
			<div class="col-2">
				<h4 class="pb-3 border-bottom">Browse Catalog</h4>
				<div class="form-group font-weight-light pt-3">
					<form method="GET" action="">
						<div class="input-group mb-2">
							<input type="text" class="form-control text-muted" name="search" placeholder="Search..">
							<div class="input-group-append">
								<button type="submit" class="form-control text-muted"><i class="fas fa-search"></i></button>
							</div>
						</div>
					</form>
				</div>
				<div class="form-group font-weight-light pt-3">
					<div class="mb-1 "><i class="fas fa-map-marked-alt"></i> Shipping Address: </div>
					<div class="text-muted text-capitalize"> <?php echo $profile->fetchLocation($_SESSION['id']); ?></div>
					<a href="profile?act=update"><small>Change address</small></a>
				</div>
				<div class="form-group font-weight-light pt-3">
					<div class="mb-1 "><i class="fas fa-tag"></i> Price</div>
					<div class="text-muted"> RM 3.90 <input type="range" min="1" max="100" value="1"> RM 59.90 </div>
				</div>
				<div class="form-group font-weight-light pt-3">
					<div class="mb-1 "><i class="fas fa-bars"></i> Category</div>
					<div class="custom-control custom-checkbox text-muted">
						<input type="checkbox" class="custom-control-input" id="customCheck1">
						<label class="custom-control-label" for="customCheck1">Clothing</label>
					</div>
					<div class="custom-control custom-checkbox text-muted">
						<input type="checkbox" class="custom-control-input" id="customCheck2">
						<label class="custom-control-label" for="customCheck2">Bags</label>
					</div>
					<div class="custom-control custom-checkbox text-muted">
						<input type="checkbox" class="custom-control-input" id="customCheck3">
						<label class="custom-control-label" for="customCheck3">Souvenir</label>
					</div>
					<div class="custom-control custom-checkbox text-muted">
						<input type="checkbox" class="custom-control-input" id="customCheck3">
						<label class="custom-control-label" for="customCheck3">Accessories</label>
					</div>
				</div>
			</div>

			<div class="col border-left">
				<?php
				if (isset($_GET['search'])) {
					echo '<h4 class="pb-3 border-bottom font-weight-light text-muted">Search result for 
					<span class="font-weight-normal font-italic" style="color:black;">"' . $_GET['search'] . '"</span></h4>';
				}
				?>
				<div class="p-2">
					<div class="card-columns">
						<?php

						foreach ($data as $row) {

							echo '<div class="card shadow">';

							if ($row['product_image'] != null) {
								echo '<img class="card-img-top" src="../../' . $row['product_image'] . '" 
										alt="Card image cap">';
							} else {
								echo '<img class="card-img-top" src="https://dummyimage.com/640x360/f0f0f0/aaa" 
										alt="Card image cap">';
							}

							echo '<div class="card-body">';
							echo '<h5 class="card-title">' . $row['product_name'] . '</h5>';
							echo '<p class="card-text text-muted">' . $row['product_desc'] . '</p>';
							echo '<p class="card-text text-muted "> In Stock: ' . $row['product_stock'] . ' Unit(s)</p>';
							echo '</div>';

							if ($row['product_stock'] != 0) {
								echo '<div class="card-footer bg-white text-right" id="' . $row['product_id'] . '">';
								echo '<h5 class="card-text float-left text-success d-inline py-1">RM ' . $row['product_price'] . '</h5>';
								echo '<a href="checkout?act=add&id=' . $row['product_id'] . '" 
										class="btn btn-success "><i class="fas fa-cart-arrow-down"></i></a>';
								echo '</div>';
							} else {
								echo '<div class="card-footer bg-white  text-right" id="' . $row['product_id'] . '">';
								echo '<h5 class="card-text float-left text-success">RM ' . $row['product_price'] . '</h5>';
								echo '<button class="btn btn-secondary" disabled>No Stock</button>';
								echo '</div>';
							}

							echo '</div>';
						}
						?>
					</div>
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

</body>

</html>