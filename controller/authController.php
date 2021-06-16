<?php
require_once ROOT_URL . '/model/authModel.php';

class AuthController
{

	function fetchName($id)
	{
		$profile = new AuthModel();
		return $profile->fetchNameData($id);
	}

	function fetchLocation($id)
	{
		$profile = new AuthModel();
		return $profile->fetchLocationData($id);
	}

	function fetchInfo($id)
	{
		$profile = new AuthModel();
		return $profile->fetchInfoData($id);
	}

	function updateProfile($id)
	{
		$comname = stripslashes($_REQUEST['comname']);
		$cominfo = stripslashes($_REQUEST['cominfo']);
		$comadd = stripslashes($_REQUEST['comadd']);

		$profile = new AuthModel();
		$res = $profile->updateProfileData($id, $comname, $cominfo, $comadd);

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
