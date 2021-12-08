<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/handcraft-store/db/config.php';
require_once ROOT_URL . '/db/auth.php';
require_once ROOT_URL . '/controller/authController.php';

$profile = new AuthController();
$auth = new Auth();
$auth->authVendor();

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

if (isset($_POST['update'])) {
	$update = new AuthController();
	$update->updateProfile($_SESSION['id']);
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
				<li class="list-group-item "><a href="order_panel" class="nav-link">Order Panel</a></li>
				<li class="list-group-item"><a href="catalog_panel" class="nav-link">Catalog Panel</a></li>
				<li class="list-group-item active"><a href="#" class="nav-link text-white">Update Profile</a></li>
			</ul>
		</div>
		<div class="col-1">
			<div class="form-group font-weight-bold pt-3">
				<a href="profile?act=logout" class="text-danger"><i class="fas fa-sign-out-alt"></i> Logout</a>
			</div>
		</div>
	</div>

	<!-- Alert -->
	<div id="alert" class="w-50 position-absolute" style="z-index: 1; top:15%; left: 25%;"></div>

	<!-- Content -->
	<div class="row p-4 m-auto">
		<!-- Vendor Info -->
		<div class="col-4 offset-md-4">
			<form action="profile" method="POST">
				<h4 class="pb-3 border-bottom text-capitalize">Update Vendor Information</h4>
				<div class="form-group font-weight-bold">
					<div class="mb-1 "><i class="fas fa-user"></i> Vendor Name</div>
					<input type="text" class="form-control" name="comname" placeholder="Vendor Name" value="<?php echo $profile->fetchName($_SESSION['id']); ?>" required>
				</div>
				<div class="form-group font-weight-bold">
					<div class="mb-1 "><i class="fas fa-info-circle"></i> Vendor Info</div>
					<textarea class="form-control" name="cominfo" placeholder="Max 500 characters." rows="5" cols="500" maxlength="500" required><?php echo $profile->fetchInfo($_SESSION['id']); ?></textarea>
				</div>
				<div class="form-group font-weight-bold">
					<div class="mb-1 "><i class="fas fa-map-marked-alt"></i> Vendor Address</div>
					<textarea class="form-control" name="comadd" placeholder="Vendor Address" rows="3"  cols="100" maxlength="100" required><?php echo $profile->fetchLocation($_SESSION['id']); ?></textarea>
				</div>
				<div class="form-group font-weight-light pt-3  text-center">
					<input type="hidden" name="update">
					<button type="submit" class="btn btn-primary">Update <i class="fas fa-chevron-right"></i></button>
				</div>
			</form>
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

	<script type="text/javascript" src="../bootstrap/js/app.js"></script>

</body>

</html>