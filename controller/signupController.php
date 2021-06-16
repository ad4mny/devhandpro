<?php
require_once ROOT_URL . '/model/signupModel.php';

class SignupController_Service {

	function signup() {

		$comname = stripslashes($_REQUEST['comname']);
		$comadd = stripslashes($_REQUEST['comadd']);
		$usr = stripslashes($_REQUEST['usr']);
		$pwd = stripslashes($_REQUEST['pwd']);
		$c_pwd = stripslashes($_REQUEST['c_pwd']);

		if ($pwd != $c_pwd) {
			header("Location: ../vendor/sign_up?not=password_mismatch_error");
		} else {
			$enc_pwd = md5($c_pwd);
		}

		$signup = new SignupModel();
		$res = $signup->signup($comname, $comadd, $usr, $enc_pwd);

		if($res > 0){
			header("Location: ../notify");
		} else {
			header("Location: ../vendor/sign_up?not=sign_up_error");
		}

	}



}