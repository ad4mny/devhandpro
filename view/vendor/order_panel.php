<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/devhandpro/db/config.php';
require_once ROOT_URL . '/db/auth.php';
require_once ROOT_URL . '/controller/authController.php';
require_once ROOT_URL . '/controller/serviceController.php';

$profile = new AuthController();
$service = new ServiceController();
$auth = new Auth();
$auth->authVendor();

$data_ship = $service->viewReadyOrder($_SESSION['com_id']);
$data_order = $service->viewRequestOrder($_SESSION['com_id']);

if (isset($_GET['act'])) {

	if ($_GET['act'] == 'logout') {
		$logout = new AuthController();
		$logout->logout();
	}

	if ($_GET['act'] == 'cancel') {
		$service->deleteOrder($_GET['id']);
	}

	if ($_GET['act'] == 'packed') {
		$service->readyOrder($_GET['id']);
	}
}

?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="../bootstrap/upload/favicon.ico">
	<title>vendor@handpro</title>
	<link rel="stylesheet" href="../bootstrap/css/all.min.css">
	<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
	<script src="../bootstrap/js/jquery.min.js"></script>
</head>

<body>

	<!-- Navigation Panel -->
	<div class="row p-4">
		<div class="col">
			<ul class="list-group list-group-horizontal">
				<li class="list-group-item "><a href="dashboard" class="nav-link">Dashboard</a></li>
				<li class="list-group-item active"><a href="#" class="nav-link text-white">Order Panel</a></li>
				<li class="list-group-item"><a href="catalog_panel" class="nav-link">Catalog Panel</a></li>
				<li class="list-group-item"><a href="profile" class="nav-link">Update Profile</a></li>
			</ul>
		</div>
		<div class="col-1">
			<div class="form-group font-weight-bold pt-3">
				<a href="order_panel?act=logout" class="text-danger"><i class="fas fa-sign-out-alt"></i> Logout</a>
			</div>
		</div>
	</div>

	<!-- Content -->
	<div class="row p-4">
		<!-- Vendor Info -->
		<div class="col-3">
			<h4 class="pb-3 border-bottom text-capitalize">Welcome, <?php echo $profile->fetchName($_SESSION['id']); ?></h4>
			<div class="form-group font-weight-bold">
				<div class="mb-1 "><i class="fas fa-user"></i> Vendor Name</div>
				<div class="text-muted font-weight-normal text-capitalize"> <?php echo $profile->fetchName($_SESSION['id']); ?></div>
			</div>
			<div class="form-group font-weight-bold">
				<div class="mb-1 "><i class="fas fa-info-circle"></i> Vendor Info</div>
				<div class="text-muted font-weight-normal"> <?php echo $profile->fetchInfo($_SESSION['id']); ?></div>
			</div>
			<div class="form-group font-weight-bold">
				<div class="mb-1 "><i class="fas fa-map-marked-alt"></i> Vendor Address</div>
				<div class="text-muted font-weight-normal text-capitalize"> <?php echo $profile->fetchLocation($_SESSION['id']); ?></div>
			</div>
			<div class="form-group font-weight-light">
				<a href="profile"><small>Update vendor profile</small></a>
			</div>
		</div>

		<div class="col border-left">
			<h2>All Order List |
				<small>
					<div class="btn-group" role="group">
						<button class="btn btn-primary active" id="order_btn">Incoming Order</button>
						<button class="btn btn-outline-primary " id="ship_btn">Shipped Order</button>
					</div>
				</small>
			</h2>

			<div id="order_display">
				<table class="table table-condensed">
					<tr>
						<th style="width:10%"></th>
						<th style="width:45%">Order Information</th>
						<th style="width:20%">Quantity Ordered</th>
						<th style="width:25%">Status</th>
					</tr>

					<?php
					$count = 1;
					if ($data_order->rowCount() > 0) {

						foreach ($data_order as $row) {
							echo '<tr>';
							echo '<td>' . $count++ . '</td>';
							echo '<td>' . $row['product_name'] . '</td>';
							echo '<td>' . $row['od_product_qty'] . 'x Unit(s)</td>';

							if ($row['od_status'] === 'Delivered') {
								echo '<td><div class="text-success"> Delivered </div> | <div class="text-muted">Delete</div></td>';
							} else if ($row['od_status'] === 'Ready') {
								echo '<td><div class="text-muted font-italic"> Shipped </div> ';
							} else {
								echo '<td><a href="order_panel?act=packed&id=' . $row['od_id'] . '" onclick="return confirm()" 
								class="text-primary">Pack Order</a> | <a href="order_panel?act=cancel&id=' . $row['od_id'] . '
								" onclick="return confirm()" class="text-danger">Cancel Order</a></td>';
							}
							echo '</tr>';
						}

					} else {
						echo "<tr><td colspan='4'><p class='p-2'>No new order yet.</p></td></tr>";
					}

					?>
				</table>
			</div>

			<div id="ship_display" style="display: none;">
				<table class="table table-condensed">
					<tr>
						<th style="width:10%"></th>
						<th style="width:45%">Order Information</th>
						<th style="width:20%">Quantity Ordered</th>
						<th style="width:25%">Status</th>
					</tr>
					<?php
					$count = 1;
					if ($data_ship->rowCount() > 0) {

						foreach ($data_ship as $row) {

							echo '<tr>';
							echo '<td>' . $count++ . '</td>';
							echo '<td>' . $row['product_name'] . '</td>';
							echo '<td>' . $row['od_product_qty'] . '</td>';

							if ($row['od_status'] === 'Delivered') {
								echo '<td><div class="text-success"> Delivered </div> | <div class="text-muted">Delete</div></td>';
							} else if ($row['od_status'] === 'Ready') {
								echo '<td><div class="text-muted font-italic"> Shipped </div> ';
							} else {
								echo '<td><a href="order_panel?act=packed&id=' . $row['od_id'] . '" onclick="return confirm()" 
								class="text-primary">Pack Order</a> | <a href="order_panel?act=cancel&id=' . $row['od_id'] . '
								" onclick="return confirm()" class="text-danger">Cancel Order</a></td>';
							}
							echo '</tr>';
						}
					} else {
						echo "<tr><td colspan='4'><p class='p-2'>No new order yet.</p></td></tr>";
					}

					?>
				</table>
			</div>
		</div>



	</div>

	<script type="text/javascript">
		$(document).ready(function() {

			$("#order_btn").on('click', function() {
				$("#order_display").show();
				$("#ship_display").hide();
				$("#order_btn").removeClass("btn-outline-primary").addClass("btn-primary active");
				$("#ship_btn").removeClass("btn-primary active").addClass("btn-outline-primary");
			});

			$("#ship_btn").on('click', function() {
				$("#ship_display").show();
				$("#order_display").hide();
				$("#ship_btn").removeClass("btn-outline-primary").addClass("btn-primary active");
				$("#order_btn").removeClass("btn-primary active").addClass("btn-outline-primary");
			});

		});
	</script>
</body>

</html>