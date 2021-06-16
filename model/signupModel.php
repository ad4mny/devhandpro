<?php
require_once ROOT_URL . '/db/database.php';

class SignupModel {
	
	function signup($comname, $comadd, $usr, $enc_pwd) {

		$sql = "BEGIN;
		INSERT INTO user (user_name, user_password, user_type)
		VALUES(:user_name, :user_password, :user_type);
		INSERT INTO serviceprovider_info (user_id, sp_companyname, sp_companyaddress, sp_status) 
		VALUES(LAST_INSERT_ID(),:sp_companyname, :sp_companyaddress, '0');
		COMMIT";

		$args = [
			':sp_companyname'=>$comname, 
			':sp_companyaddress'=>$comadd, 
			':user_name'=>$usr, 
			':user_password'=>$enc_pwd, 
			':user_type'=>2
		];
		DB::run($sql, $args);

		$sql = "select user_id from user WHERE user_name=:user_name AND user_password=:user_password";

		$args = [
			':user_name' => $usr,
			':user_password' => $enc_pwd
		];
		
		$count = DB::run($sql, $args)->rowCount();

		return $count;

	}


}