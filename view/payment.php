<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/devhandpro/db/config.php';
require_once ROOT_URL . '/db/auth.php';
require_once ROOT_URL . '/controller/checkoutController.php';
require_once ROOT_URL . '/controller/paymentController.php';

$checkout = new CheckoutController();
$payment = new PaymentController();
$data = $checkout->viewCart();
$auth = new Auth();
$auth->authUser();

if (isset($_GET['act'])) {
	if ($_GET['act'] == 'payment') {
		if ($_GET['flag'] == 'pay') {
			$payment->addTransaction($_GET['return']);
		}
	}
}

?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="bootstrap/upload/favicon.ico">
	<title>E-Shopping HandPro</title>
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="bootstrap/css/all.min.css">
	<link rel="stylesheet" href="bootstrap/css/badge.css">
	<script type="text/javascript" src="bootstrap/js/jquery.min.js"></script>
	<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
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
						<a class="nav-link" href="user/home">Home<span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item ">
						<a class="nav-link" href="user/shop">Shops</a>
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
							<a class="dropdown-item" href="user/profile">Profile</a>
							<a class="dropdown-item" href="user/home?act=logout">Logout</a>
						</div>
					</li>
				</ul>
			</div>
		</nav>
		<div class="container h-100">
			<div class="row h-100 align-items-center">
				<div class="col-12 text-white">
					<h1 class="font-weight-lighter">Payment</h1>
				</div>
			</div>
		</div>
	</header>

	<!-- Display Notice -->
	<div class="m-5 h-75" id="success_display" style="display: none;">
		<div class="row ">
			<div class="col text-center p-5">
				<h1 class="display-4 text-primary"><i class="fas fa-clipboard-check"></i> Payment Successful!</h1>
				<p class="font-weight-light">Now please sit back and wait before your precious order is completed.</p>
				<a href="user/home"><i class="fas fa-chevron-left"></i> Back to homepage</a>
			</div>
		</div>
	</div>

	<!-- Display Notice -->
	<div class="m-5 h-75" id="failed_display" style="display: none;">
		<div class="row ">
			<div class="col text-center p-5">
				<h1 class="display-4 text-danger"><i class="fas fa-times-circle"></i> Payment Failed!</h1>
				<p class="font-weight-light">It's either the transaction failed or you have canceled it :(</p>
				<a href="user/home"><i class="fas fa-chevron-left"></i> Back to homepage</a>
			</div>
		</div>
	</div>

	<!-- Payment Content -->
	<div class="p-5" id="payment_display">

		<div class="row">
			<div class="col">
				<h4 class="pb-3">Select Payment Method</h4>
			</div>
		</div>

		<!-- Payment Option -->
		<div class="row border-bottom">
			<div class="col-2">
				<div class="form-group">
					<div class="radio">
						<div class="btn btn-outline-dark btn-block py-5">
							<label><input type="radio" name="payment" checked value="cash"> <i class="fas fa-wallet"></i> Cash On Delivery</label>
						</div>
					</div>
				</div>
			</div>
			<div class="col-2">
				<div class="form-group">
					<div class="radio">
						<div class="btn btn-outline-dark btn-block  py-5">
							<label><input type="radio" name="payment" value="paypal"> <i class="fab fa-cc-paypal"></i> Paypal</label>
						</div>
					</div>
				</div>
			</div>
			<div class="col-2">
				<div class="form-group">
					<div class="radio disabled">
						<div class="btn btn-outline-dark btn-block disabled  py-5">
							<label><input type="radio" name="payment" disabled> <i class="fas fa-credit-card"></i> Online Banking</label>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row mt-5">
			<div class="col">
				<h4 class="pb-3">Your basket items</h4>
			</div>
		</div>

		<div class="row ">
			<div class="col pb-5 mb-5">
				<table id="cart" class="table table-condensed">
					<thead>
						<tr>
							<th style="width:50%">Order Info</th>
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

												echo '<div class="col-3 hidden-xs"><img src="../' . $row['product_image'] . '" alt="No available Image" class="img-fluid"/></div>';
											} else {

												echo '<div class="col-3 hidden-xs"><img src="http://placehold.it/100x100" alt="No available Image" class="img-fluid"/></div>';
											}

											?>

											<div class="col">
												<h4 class="nomargin"><?php echo $row['product_name']; ?></h4>
												<p><?php echo $row['product_desc']; ?></p>
											</div>
										</div>
									</td>
									<td data-th="Price" class="font-weight-light"><?php echo number_format((float)$row['product_price'], 2, '.', ''); ?></td>
									<td data-th="Quantity" class="font-weight-light">
										<p><?php echo $_SESSION['cart'][$id]; ?></p>
									</td>
									<td data-th="Subtotal" class="font-weight-light"><?php echo number_format((float)($row['product_price'] * $_SESSION['cart'][$id]), 2, '.', ''); ?></td>
								</tr>

						<?php

								$tot_prc = $tot_prc + $row['product_price'] * $_SESSION['cart'][$id];
							}

							$_SESSION['amt'] = number_format((float)round($tot_prc + (6 / 100 * ($tot_prc) + 3.90), 1), 2, '.', '');
						}
						?>

					</tbody>
					<tfoot>
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
								<div class="font-weight-light">: RM <?php echo number_format((float)round(($tot_prc + (6 / 100 * ($tot_prc) + 3.90)), 1), 2, '.', ''); ?></div>
								<small class="text-muted">(Rounded to nearest ten)</small>
							</td>
						</tr>
						<tr>
							<td colspan="3" class="hidden-xs"></td>
							<td>
								<div id="cash">
									<a href="payment?act=payment&flag=pay&return=cash" class="btn btn-success btn-block">Confirm Order</a>
								</div>
								<div id="paypal" style="display: none;">
									<form action="<?php echo PAYPAL_URL; ?>" method="post">
										<input type="hidden" name="business" value="<?php echo PAYPAL_ID; ?>">
										<input type="hidden" name="cmd" value="_xclick">
										<input type="hidden" name="item_name" value="<?php echo 'Sonic Product & Services'; ?>">
										<input type="hidden" name="item_number" value="">
										<input type="hidden" name="amount" value="<?php echo number_format((float)round($tot_prc + (6 / 100 * ($tot_prc) + 3.90), 1), 2, '.', ''); ?>">
										<input type="hidden" name="currency_code" value="<?php echo PAYPAL_CURRENCY; ?>">

										<input type="hidden" name="return" value="<?php echo PAYPAL_RETURN_URL; ?>">
										<input type="hidden" name="cancel_return" value="<?php echo PAYPAL_CANCEL_URL; ?>">
										<input type="submit" name="submit" class="btn btn-primary btn-block" value="Pay Now">
									</form>
								</div>
							</td>
						</tr>
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

	<script type="text/javascript">
		$(document).ready(function() {

			var url_string = window.location.href;
			var url = new URL(url_string);
			var flag = url.searchParams.get("flag");

			if (flag === 'success') {
				$("#success_display").show();
				$("#failed_display").hide();
				$("#payment_display").hide();
			} else if (flag === 'cancel') {
				$("#success_display").hide();
				$("#failed_display").show();
				$("#payment_display").hide();
			} else {
				$("#success_display").hide();
				$("#failed_display").hide();
				$("#payment_display").show();
			}

			$("input[name='payment']").change(function(e) {
				var payment_type = $("input[name='payment']:checked").val();
				console.log(payment_type);

				if (payment_type == "cash") {
					$("#cash").show();
					$("#paypal").hide();
				} else {
					$("#cash").hide();
					$("#paypal").show();
				}
			});
		});
	</script>
</body>

</html>