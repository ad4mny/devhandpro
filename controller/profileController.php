<?php
require_once ROOT_URL . '/model/profileModel.php';

class ProfileController {

	function fetchFirstName($id) {

		$profile = new ProfileModel();
		return $profile->fetchFirstNameData($id);

	}

	function fetchLastName($id) {

		$profile = new ProfileModel();
		return $profile->fetchLastNameData($id);

	}

	function fetchName($id) {

		$profile = new ProfileModel();
		return $profile->fetchNameData($id);

	}

	function fetchLocation($id) {

		$profile = new ProfileModel();
		return $profile->fetchLocationData($id);

	}

	function fetchPhone($id) {

		$profile = new ProfileModel();
		return $profile->fetchPhoneData($id);

	}	
	

}