<?php
require_once ROOT_URL . '/db/database.php';

class ProfileModel
{


	function fetchFirstNameData($id)
	{
		$sql = "select c_firstname, c_lastname from customer_info where user_id=:user_id";
		$args = [':user_id' => $id];
		$stmt = DB::run($sql, $args);
		$data = $stmt->fetch();
		return $data['c_firstname'];
	}

	function fetchLastNameData($id)
	{
		$sql = "select c_firstname, c_lastname from customer_info where user_id=:user_id";
		$args = [':user_id' => $id];
		$stmt = DB::run($sql, $args);
		$data = $stmt->fetch();
		return $data['c_lastname'];
	}

	function fetchNameData($id)
	{
		$sql = "select c_firstname, c_lastname from customer_info where user_id=:user_id";
		$args = [':user_id' => $id];
		$stmt = DB::run($sql, $args);
		$data = $stmt->fetch();
		return $data['c_firstname'] . " " . $data['c_lastname'];
	}

	function fetchLocationData($id)
	{
		$sql = "select c_address from customer_info where user_id=:user_id";
		$args = [':user_id' => $id];
		$stmt = DB::run($sql, $args);
		$data = $stmt->fetch();
		return $data['c_address'];
	}

	function fetchPhoneData($id)
	{
		$sql = "select c_phonenum from customer_info where user_id=:user_id";
		$args = [':user_id' => $id];
		$stmt = DB::run($sql, $args);
		$data = $stmt->fetch();
		return $data['c_phonenum'];
	}


	
}
