<?php
require_once ROOT_URL . '/model/loginModel.php';

class LoginController
{

	function loginAuth()
	{

		$usr = stripslashes($_REQUEST['usr']);
		$pwd = stripslashes($_REQUEST['pwd']);

		$login = new LoginModel();
		$res = $login->loginAuth($usr, $pwd);

		if ($res > 0) {
			switch ($_SESSION['type']) {
				case 3:
					$login->loginRoles(3);
					if ($_SESSION['status'] != '0') {
						header("Location: ../view/admin/dashboard");
					} 
					break;
				case 2:
					$login->loginRoles(2);
					if ($_SESSION['status'] != '0') {
						header("Location:  ../view/vendor/dashboard");
					} else {
						header("Location: ../view/notify");
					}
					break;
				default:
					$login->loginRoles(0);
					header("Location: ../view/user/home");
					break;
			}
		} else {
			header('location: login?not=login_error');
		}
	}


	function signupCust()
	{

		$fname = stripslashes($_REQUEST['fname']);
		$lname = stripslashes($_REQUEST['lname']);
		$phone = stripslashes($_REQUEST['phone']);
		$address = stripslashes($_REQUEST['address']);
		$usr = stripslashes($_REQUEST['usr']);
		$pwd = stripslashes($_REQUEST['pwd']);
		$c_pwd = stripslashes($_REQUEST['c_pwd']);

		if ($pwd != $c_pwd) {
			header("Location: ../view/user/sign_up?not=password_mismatch_error");
			exit();
		} else {
			$enc_pwd = md5($c_pwd);
		}

		$login = new LoginModel();
		$res = $login->signupCustomer($fname, $lname, $phone, $address, $usr, $enc_pwd);

		if ($res > 0) {
			header("Location: home");
		}
	}

	function updateProfile($id)
	{
		$fname = stripslashes($_REQUEST['fname']);
		$lname = stripslashes($_REQUEST['lname']);
		$phone = stripslashes($_REQUEST['phone']);
		$address = stripslashes($_REQUEST['address']);

		$update = new LoginModel();
		$res = $update->updateProfileData($id, $fname, $lname, $phone, $address);

		if ($res > 0) {
			header("Location: profile?not=update_success");
		} else {
			header("Location: profile?not=update_error");
		}
	}

	function logout()
	{
		session_destroy();
		header("Location: ../../view/login?not=logout");
	}
}
