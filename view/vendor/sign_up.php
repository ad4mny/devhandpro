<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/handcraft-store/db/config.php';
require_once ROOT_URL . '/controller/signupController.php';

if (isset($_POST['submit'])) {
    $login = new SignupController_Service();
    $login->signup();
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../bootstrap/upload/favicon.ico">
    <title>HandPro</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap-square.css">
    <link rel="stylesheet" href="../bootstrap/css/all.min.css">
    <script type="text/javascript" src="../bootstrap/js/jquery.min.js"></script>
    <script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
    <style type="text/css">
        body,
        html {
            position: relative;
            min-height: 120vh;
            background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)),
                url('https://source.unsplash.com/rlbG0p_nQOU/1920x1080');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
    </style>
</head>

<body class="bg-light">

    <!-- Alert -->
    <div id="alert" class="w-50 position-absolute" style="z-index: 1; top:5%; left: 25%;"></div>

    <!-- Content -->
    <div class="container">
        <div class="bg-white w-50 m-auto p-5 " >

            <!-- Signup form -->
            <div class="row">
                <div class="col">
                    <form method="post" action="sign_up">
                        <div class="border-bottom text-center">
                            <h4>Vendor Registration Form</h4>
                        </div>
                        <div class="border-bottom py-3">
                            <div class="form-group">
                                <input type="text" class="form-control" name="comname" placeholder="Vendor Name" required>
                            </div>

                            <div class="form-group">
                                <textarea class="form-control" name="comadd" placeholder="Vendor Address" rows="3"  cols="100" maxlength="100" required></textarea>
                            </div>

                            <div class="form-group">
                                <textarea class="form-control" name="cominfo" placeholder="Vendor Info" rows="3"  cols="500" maxlength="500" required></textarea>
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control" name="usr" placeholder="Username" required>
                            </div>

                            <div class="form-group">
                                <input type="password" class="form-control" name="pwd" placeholder="Password" required>
                            </div>

                            <div class="form-group">
                                <input type="password" class="form-control" name="c_pwd" placeholder="Confirm Password" required>
                            </div>

                            <div class="form-group text-center">
                                <input type="submit" class="btn btn-primary btn-block" name="submit" value="Sign up">
                            </div>
                        </div>
                        <div class="form-group text-center pt-3">
                            <small class="text-muted">Already have an account? Login <a href="../login">here</a></small>

                        </div>
                    </form>
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

    <script type="text/javascript" src="../bootstrap/js/app.js"></script>

</body>

</html>