<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/handcraft-store/db/config.php';
require_once ROOT_URL . '/db/auth.php';
require_once ROOT_URL . '/controller/authController.php';
require_once ROOT_URL . '/controller/serviceController.php';

$profile = new AuthController();
$service = new ServiceController();
$auth = new Auth();
$auth->authVendor();

$data = $service->viewProduct($_GET['id']);

if (isset($_GET['act'])) {

	if ($_GET['act'] == 'logout') {
		$logout = new AuthController();
		$logout->logout();
	}

	if ($_GET['act'] == 'del') {
		$service->deleteProduct($_GET['id']);
	}
}

if (isset($_POST['submit'])) {
	$service->updateProduct($_GET['id']);
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
			<h2 class="border-bottom">Product Catalog Update</h2>

			<div class="row">
				<div class="col">

					<form action="" method="post" enctype="multipart/form-data">
						<?php
						if ($data != null) {

							foreach ($data as $row) {
						?>
								<div class="row py-2">
									<div class="col-2">
										<div>Product ID</div>
									</div>
									<div class="col">
										<input type="text" class="form-control" name="product_id" value="<?php echo $row['product_id']; ?>" disabled>
									</div>
								</div>

								<div class="row py-2">
									<div class="col-2">
										<div>Product Category</div>
									</div>
									<div class="col">
										<input type="text" class="form-control" name="product_category" value="<?php echo $row['product_category']; ?>">
									</div>
								</div>

								<div class="row py-2">
									<div class="col-2">
										<div>Product Image</div>
									</div>
									<div class="col">
										<input type='file' id="product_picture" name="product_image">
									</div>
								</div>

								<div class="row py-2">
									<div class="col-2">
										<div>Product Name</div>
									</div>
									<div class="col">
										<input type="text" class="form-control" name="product_name" cols="50" maxlength="50" value="<?php echo $row['product_name']; ?>">
									</div>
								</div>

								<div class="row py-2 ">
									<div class="col-2">
										<div>Product Price</div>
									</div>
									<div class="col">
										<div class="input-group mb-3">
											<div class="input-group-prepend">
												<span class="input-group-text" id="basic-addon1">RM</span>
											</div>
											<input type="number" step="0.01" class="form-control" name="product_price" value="<?php echo $row['product_price']; ?>">
										</div>
									</div>
								</div>

								<div class="row py-2">
									<div class="col-2">
										<div>Product Description</div>
									</div>
									<div class="col">
										<textarea rows="3" class="form-control" name="product_desc" cols="100" maxlength="100" placeholder="Max 100 characters."><?php echo $row['product_desc']; ?></textarea>
									</div>
								</div>

								<div class="row py-2">
									<div class="col-2">
										<div>Product Quantity</div>
									</div>
									<div class="col">
										<div class="input-group mb-3">
											<input type="number" class="form-control" name="product_stock" value="<?php echo $row['product_stock']; ?>">
											<div class="input-group-prepend">
												<span class="input-group-text" id="basic-addon1">Stock</span>
											</div>
										</div>
									</div>
								</div>

								<div class="row py-2">
									<div class="col text-right">
										<input type="submit" name="submit" class="btn btn-primary " value="Update product">
									</div>
								</div>
						<?php
							}
						}
						?>
					</form>
				</div>

				<div class="col">
					<img src="../../view/<?php echo $row['product_image']; ?>" alt="preview product image here" id="preview" width="350" style="border: 1px solid #ddd; border-radius: 4px;padding: 5px;">
				</div>

			</div>
		</div>
	</div>

	<!-- Script -->
	<script type="text/javascript">
		function readURL(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();

				reader.onload = function(e) {
					$('#preview').attr('src', e.target.result);
				}

				reader.readAsDataURL(input.files[0]);
			}
		}

		$("#product_picture").change(function() {
			readURL(this);
		});
	</script>

</body>

</html>