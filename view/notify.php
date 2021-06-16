<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<title>SONIC Runner System</title>
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
			background-image: linear-gradient(169deg, rgba(0, 0, 0, 1) 0%, rgba(0, 0, 0, 0.3225665266106442) 50%,
					rgba(0, 0, 0, 1) 100%), url('https://source.unsplash.com/rlbG0p_nQOU/1920x1080');
			background-size: cover;
			background-position: center;
			background-repeat: no-repeat;
		}
	</style>
</head>

<body class="bg-light">



	<div class="alert text-center bg-light sticky-top w-75 p-3 shadow m-auto alert-dismissible fade show" role="alert">
		<h5>Thank you for joining our family!</h5>
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>

	<!-- Alert -->
	<div id="alert" style="position:absolute;z-index:1;"></div>

	<!-- Content -->
	<div class="position-absolute m-auto bg-white p-5 m-5 w-50" style="top: 50%; left: 50%; transform: translate(-50%, -50%); ">
		<div class="row">
			<div class="col text-center p-5">
				<h1 class="display-4 text-primary"><i class="fas fa-clipboard-check"></i> Request Pending!</h1>
				<p class="font-weight-light">Now please sit back and wait before your request is approved.</p>
				<a href="login"><i class="fas fa-chevron-left"></i> Back to login</a>
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