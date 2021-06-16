<?php
require_once ROOT_URL . '/db/database.php';

class AuthModel
{
	function fetchNameData($id)
	{
		$sql = "select sp_companyname from serviceprovider_info where user_id=:user_id";
		$args = [':user_id' => $id];
		$stmt = DB::run($sql, $args);
		$data = $stmt->fetch();
		return $data['sp_companyname'];
	}

	function fetchLocationData($id)
	{
		$sql = "select sp_companyaddress from serviceprovider_info where user_id=:user_id";
		$args = [':user_id' => $id];
		$stmt = DB::run($sql, $args);
		$data = $stmt->fetch();
		return $data['sp_companyaddress'];
	}

	function fetchInfoData($id)
	{
		$sql = "select sp_info from serviceprovider_info where user_id=:user_id";
		$args = [':user_id' => $id];
		$stmt = DB::run($sql, $args);
		$data = $stmt->fetch();
		return $data['sp_info'];
	}

	function updateProfileData($id, $comname, $cominfo, $comadd)
	{
		$sql = "update serviceprovider_info set sp_companyname=:sp_companyname, sp_companyaddress=:sp_companyaddress, 
		sp_info=:sp_info where user_id=:user_id";
		$args = [
			':sp_companyname' => $comname,
			':sp_companyaddress' => $comadd,
			':sp_info' => $cominfo,
			':user_id' => $id
		];
		$stmt = DB::run($sql, $args);
		$count = $stmt->rowCount();

		return $count;
	}
}
