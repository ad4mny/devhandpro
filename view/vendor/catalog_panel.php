<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/devhandpro/db/config.php';
require_once ROOT_URL . '/db/auth.php';
require_once ROOT_URL . '/controller/authController.php';
require_once ROOT_URL . '/controller/serviceController.php';

$profile = new AuthController();
$service = new ServiceController();
$auth = new Auth();
$auth->authVendor();

$data = $service->viewAllProduct($_SESSION['com_id']);

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
				<li class="list-group-item "><a href="dashboard" class="nav-link">Dashboard</a></li>
				<li class="list-group-item "><a href="order_panel" class="nav-link">Order Panel</a></li>
				<li class="list-group-item active"><a href="#" class="nav-link  text-white">Catalog Panel</a></li>
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
			<h2>Catalog List | <small><a href="product_list_add" class="btn btn-primary">Add New Product</a> </small></h2>
			<table class="table">
				<tr>
					<th width="5%"></th>
					<th width="15%">Image</th>
					<th width="25%">Name</th>
					<th width="25%">Description</th>
					<th width="10%">Price</th>
					<th width="5%">Stock</th>
					<th width="15%"></th>
				</tr>
				<?php
				$num = 1;
				if ($data->rowCount() > 0) {

					foreach ($data as $row) {
						echo '<tr>';
						echo '<td>' . $num++ . '</td>';
						echo '<td><img class="img-fluid" width="150" src="../../' . $row['product_image'] . '" alt="no image"></td>';
						echo '<td>' . $row['product_name'] . '<br><small class="text-muted"> Category: ' . $row['product_category'] . '</small></td>';
						echo '<td>' . $row['product_desc'] . '</td>';
						echo '<td>' . $row['product_price'] . '</td>';
						echo '<td>' . $row['product_stock'] . '</td>';
						echo '<td>';
						echo '<a href="product_list_update?id=' . $row['product_id'] . '" class="text-info">Update</a><br>';
						echo '<a href="product_list_update?act=del&id=' . $row['product_id'] . '" class="text-danger">Delete</a>';
						echo '</td>';
						echo '</tr>';
					}
				} else {
					echo "<tr><td colspan='4'><p class='p-2'>Start create a new catalog now.</p></td></tr>";
				}
				?>
			</table>
		</div>

	</div>
</body>

</html>