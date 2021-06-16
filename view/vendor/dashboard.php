<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/devhandpro/db/config.php';
require_once ROOT_URL . '/db/auth.php';
require_once ROOT_URL . '/controller/authController.php';
require_once ROOT_URL . '/controller/serviceController.php';


$profile = new AuthController();
$service = new ServiceController();
$auth = new Auth();
$auth->authVendor();

$data = $service->viewStat($_SESSION['com_id']);

if (isset($_GET['act'])) {
	if ($_GET['act'] == 'logout') {
		$logout = new AuthController();
		$logout->logout();
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
				<li class="list-group-item active"><a href="#" class="nav-link text-white">Dashboard</a></li>
				<li class="list-group-item "><a href="order_panel" class="nav-link">Order Panel</a></li>
				<li class="list-group-item "><a href="catalog_panel" class="nav-link ">Catalog Panel</a></li>
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
				<div class="text-muted font-weight-normal "> <?php echo $profile->fetchInfo($_SESSION['id']); ?></div>
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
			<h2 class="border-bottom pb-3">Monthly Statistic</h2>
			<?php
			if ($data != null) {
			?>
				<div class="row">
					<div class="col-3">
						<h5>Current Order Received: </h5>
					</div>
					<div class="col">
						<h5 class="font-weight-light"><?php echo $data['processing']; ?></h5>
					</div>
				</div>
				<div class="row">
					<div class="col-3">
						<h5>Total Order Received: </h5>
					</div>
					<div class="col">
						<h5 class="font-weight-light"><?php echo $data['processing'] + $data['ready']; ?></h5>
					</div>
				</div>
				<div class="row">
					<div class="col-3">
						<h5>Total Order Shipped: </h5>
					</div>
					<div class="col">
						<h5 class="font-weight-light"><?php echo $data['ready']; ?></h5>
					</div>
				</div>
			<?php
			}
			?>
		</div>

	</div>
</body>

</html>