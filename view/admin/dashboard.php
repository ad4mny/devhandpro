<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/devhandpro/db/config.php';
require_once ROOT_URL . '/controller/adminController.php';

$admin = new adminController();
$data = $admin->viewsp();

if (isset($_POST['approvesp'])) {
	$admin->approvalsp();
	header("Location: dashboard");
}
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="../bootstrap/upload/favicon.ico">
	<title>admin@handpro</title>
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
	</style>
</head>

<body class="bg-light">

	<!-- Navigation Panel -->
	<div class="row p-4">
		<div class="col">
			<ul class="list-group list-group-horizontal">
				<li class="list-group-item active"><a href="#" class="nav-link text-white">Dashboard</a></li>
			</ul>
		</div>
		<div class="col-1">
			<div class="form-group font-weight-bold pt-3">
				<a href="../login?not=logout" class="text-danger"><i class="fas fa-sign-out-alt"></i> Logout</a>
			</div>
		</div>
	</div>

	<!-- Content -->
	<div class="container">
		<div class="row p-4">
			<div class="col">
				<h2>Approval of Vendor Registration</small></h2>

			</div>
		</div>
		<div class="row p-4">
			<div class="col">
				<div class="card-columns">
					<?php
					if ($data != null) {
						foreach ($data as $row) {
					?>
							<form action="" method="POST">
								<div class="card text-right" style="width: 18rem;">
									<div class="card-body">
										<h5 class="card-title">Company Name: <?php echo $row['sp_companyname']; ?></h5>
										<input type="hidden" name="sp_id" value="<?= $row['sp_id'] ?>">
										<input id="approvesp" type="submit" class="btn btn-primary mb-2" name="approvesp" value="Approve">
									</div>
									</td>
								</div>
							</form>
					<?php
						}
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

</body>

</html>