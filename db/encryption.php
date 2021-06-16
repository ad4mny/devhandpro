<?php 

class Encryption {
	
	function encryptIt( $q ) {

		$key = 'HqE0luoquf';

		return base64_encode(base64_encode($key.$q));
	}

	function decryptIt( $q ) {

		$key = 'HqE0luoquf';
		$decoded_key =  base64_decode(base64_decode($q));

		return str_replace("HqE0luoquf", "", $decoded_key);

	}
}

?>