<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/handcraft-store/db/config.php';
require_once ROOT_URL . '/db/auth.php';
require_once ROOT_URL . '/controller/checkoutController.php';

$checkout = new CheckoutController();
$data = $checkout->viewCart();
$auth = new Auth();
$auth->authUser();

if (isset($_GET['act'])) {

	if ($_GET['act'] == 'add') {
		$checkout->addCart($_GET['id']);
		header('Location: checkout');
	}

	if ($_GET['act'] == 'del') {
		$checkout->deleteCart($_GET['id']);
		header('Location: checkout');
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
			height: 25vh;
			background-image: linear-gradient(90deg, rgba(2, 0, 36, 1) 0%, rgba(128, 255, 140, 0.40379901960784315) 60%,
					rgba(128, 255, 140, 1) 100%), url('https://source.unsplash.com/rlbG0p_nQOU/1920x1080');
			background-size: cover;
			background-position: center;
			background-repeat: no-repeat;
		}
	</style>
</head>

<body class="bg-light min-vh-100">

	<!-- Full Page Image Header with Vertically Centered Content -->
	<header class="masthead">

		<!-- Navbar -->
		<nav class="navbar navbar-expand-lg sticky-top bg-light navbar-dark bg-transparent">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarTogglerDemo01">
				<a class="navbar-brand" href="#">HandPro</a>
				<ul class="navbar-nav mr-auto">
					<li class="nav-item ">
						<a class="nav-link" href="home">Home<span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item ">
						<a class="nav-link" href="shop">Shops</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#">About Us</a>
					</li>
				</ul>
				<ul class="navbar-nav ml-auto">
					<li class="nav-item">
						<a href="checkout" class="nav-link active"><i class="fas fa-shopping-basket"></i>
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
					<h1 class="font-weight-lighter">Checkout</h1>
				</div>
			</div>
		</div>

	</header>

	<!-- Content -->
	<div class="p-5">
		<div class="row">
			<div class="col pb-5 mb-5">
				<h4 class="pb-3">Shopping Basket</h4>
				<table id="cart" class="table table-hover table-condensed">
					<thead>
						<tr>
							<th style="width:60%">Order Info</th>
							<th style="width:10%">Price</th>
							<th style="width:15%">Quantity</th>
							<th style="width:15%">Subtotal</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$tot_prc = 0;
						if (!empty($_SESSION['cart'])) {
							foreach ($data as $row) {
								$id = $row['product_id'];
						?>
								<tr>
									<td data-th="Product">
										<div class="row">
											<?php
											if ($row['product_image'] != null) {
												echo '<div class="col-3 hidden-xs"><img src="../../' . $row['product_image'] . '" 
												alt="No available Image" class="img-fluid"/></div>';
											} else {
												echo '<div class="col-3 hidden-xs"><img src="http://placehold.it/100x100" 
												alt="No available Image" class="img-fluid"/></div>';
											}
											?>
											<div class="col">
												<h4 class="nomargin"><?php echo $row['product_name']; ?></h4>
												<p><?php echo $row['product_desc']; ?></p>
											</div>
										</div>
									</td>
									<td data-th="Price" class="font-weight-light">
										<?php echo number_format((float)$row['product_price'], 2, '.', ''); ?>
									</td>
									<td data-th="Quantity" class="font-weight-light">
										<nav>
											<ul class="pagination">
												<li class="page-item"><a class="page-link" href="checkout?act=del&id=<?php echo $id; ?>">-</a></li>
												<li class="page-item disabled"><a class="page-link" href="#"><?php echo $_SESSION['cart'][$id]; ?></a></li>
												<li class="page-item"><a class="page-link" href="checkout?act=add&id=<?php echo $id; ?>">+</a></li>
											</ul>
										</nav>
									</td>
									<td data-th="Subtotal" class="font-weight-light"><?php echo number_format((float)($row['product_price'] * $_SESSION['cart'][$id]), 2, '.', ''); ?></td>
								</tr>
						<?php
								$tot_prc = $tot_prc + $row['product_price'] * $_SESSION['cart'][$id];
							}
						} else {
							echo '<tr><td colspan="5"><p>Nothing yet in your cart :( <br><small> Order something now!</small></p></td></tr>';
						}
						?>
					</tbody>
					<tfoot>
						<?php
						if (!empty($_SESSION['cart'])) {
						?>
							<tr>
								<td colspan="2" class="hidden-xs"></td>
								<td>
									<strong>Subtotal</strong><br>
									<strong>Service Charge (6%)</strong><br>
									<strong>Shipping Charge</strong><br>
									<strong>Total Payment</strong>
								</td>
								<td class="hidden-xs ">
									<div class="font-weight-light">: RM <?php echo number_format((float)($tot_prc), 2, '.', ''); ?></div>
									<div class="font-weight-light">: RM <?php echo number_format((float)(6 / 100 * ($tot_prc)), 2, '.', ''); ?></div>
									<div class="font-weight-light">: RM <?php echo '3.90'; ?></div>
									<div class="font-weight-light">: RM <?php echo number_format((float)round($tot_prc + (6 / 100 * ($tot_prc) + 3.90), 1), 2, '.', ''); ?></div>
									<small class="text-muted">(Rounded to nearest ten)</small>
								</td>
							</tr>
							<tr>
								<td colspan="3" class="hidden-xs"></td>
								<td>
									<a href="../payment" class="btn btn-primary btn-block">Checkout <i class="fa fa-angle-right"></i></a>
								</td>
							</tr>
						<?php
						}

						?>
					</tfoot>
				</table>
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