<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/devhandpro/db/config.php';
require_once ROOT_URL . '/controller/loginController.php';

if (isset($_POST['submit'])) {
    $login = new LoginController();
    $result = $login->loginAuth();
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="bootstrap/upload/favicon.ico">
    <title>HandPro</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap-square.css">
    <link rel="stylesheet" href="bootstrap/css/all.min.css">
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
        <h5>Interested to join the family? Become a <a href="vendor/sign_up">vendor</a> now!</h5>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

	<!-- Alert -->
	<div id="alert" class="w-50 position-absolute" style="z-index: 1; top:10%; left: 25%;"></div>

    <!-- Content -->
    <div class="position-absolute m-auto bg-white p-5 m-5" style="top: 50%; left: 50%; transform: translate(-50%, -50%); width:27%;">

        <!-- Login form -->
        <div class="row">
            <div class="col">
                <form method="post" action="">
                    <div class="border-bottom text-center">
                        <h4>Login</h4>
                    </div>
                    <div class="border-bottom py-3">
                        <div class="form-group">
                            <input type="text" class="form-control" name="usr" placeholder="Username" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="pwd" placeholder="Password" required>
                        </div>
                        <div class="form-group text-center">
                            <input type="submit" class="btn btn-primary btn-block" name="submit" value="Login">
                        </div>
                    </div>
                    <div class="form-group text-center pt-3">
                        <small class="text-muted">Don't have an account yet? Sign up <a href="user/sign_up" value="sign_up">here</a></small>
                    </div>
                </form>

            </div>
        </div>

    </div>

    <!-- Footer -->
    <footer class="page-footer font-small blue w-100" style="position: absolute; bottom: 0;">
        <div class="footer-copyright text-center py-2 bg-white">
            <small>HandPro &copy; 2020</small>
        </div>
    </footer>

    <script type="text/javascript" src="bootstrap/js/app.js"></script>
    
</body>

</html>