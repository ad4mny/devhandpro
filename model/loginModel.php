<?php
require_once ROOT_URL . '/db/database.php';

class LoginModel
{

	function loginAuth($usr, $pwd)
	{

		$sql = "select * from user WHERE user_name=:user_name AND user_password=:user_password";

		$args = [
			':user_name' => $usr,
			':user_password' => md5($pwd)
		];

		$stmt = DB::run($sql, $args);
		
		$count = $stmt->rowCount();
		$data = $stmt->fetch();

		$_SESSION['id'] = $data["user_id"];
		$_SESSION['type'] = $data["user_type"];

		return $count;
	}

	function loginRoles($roles)
	{

		switch ($roles) {

			case 3:
				$sql = "select * from user WHERE user_id=:user_id ";

				$args = [
					':user_id' => $_SESSION['id']
				];

				$stmt = DB::run($sql, $args);
				$data = $stmt->fetch();

				$_SESSION['com_id'] = $data["sp_id"];
				$_SESSION['name'] = $data["sp_companyname"];
				$_SESSION['service'] = $data["sp_servicetype"];
				$_SESSION['status'] = $data["sp_status"];
				break;
			case 2:
				$sql = "select * from serviceprovider_info WHERE user_id=:user_id ";

				$args = [
					':user_id' => $_SESSION['id']
				];

				$stmt = DB::run($sql, $args);
				$data = $stmt->fetch();

				$_SESSION['com_id'] = $data["sp_id"];
				$_SESSION['name'] = $data["sp_companyname"];
				$_SESSION['service'] = $data["sp_servicetype"];
				$_SESSION['status'] = $data["sp_status"];
				break;
			default:
				$sql = "select * from customer_info WHERE user_id=:user_id";

				$args = [
					':user_id' => $_SESSION['id']
				];

				$stmt = DB::run($sql, $args);
				$data = $stmt->fetch();

				$_SESSION['cus_id'] = $data["c_id"];
				$_SESSION['name'] = $data["c_firstname"] . " " . $data["c_lastname"];
				$_SESSION['status'] = 'active';
				break;
		}

		return true;
	}

	function signupCustomer($fname, $lname, $phone, $address, $usr, $enc_pwd)
	{

		$sql = "BEGIN;
		INSERT INTO user (user_name, user_password, user_type)
		VALUES(:user_name, :user_password, :user_type);
		INSERT INTO customer_info (user_id, c_firstname, c_lastname, c_phonenum, c_address) 
		VALUES(LAST_INSERT_ID(),:c_firstname, :c_lastname, :c_phonenum, :c_address);
		COMMIT";

		$args = [
			':c_firstname' => $fname,
			':c_lastname' => $lname,
			':c_phonenum' => $phone,
			':c_address' => $address,
			':user_name' => $usr,
			':user_password' => $enc_pwd,
			':user_type' => 0
		];

		DB::run($sql, $args);

		$sql = "select user_id from user WHERE user_name=:user_name AND user_password=:user_password";

		$args = [
			':user_name' => $usr,
			':user_password' => $enc_pwd
		];

		$stmt = DB::run($sql, $args);
		$data = $stmt->fetch();


		$sql = "select * from customer_info WHERE user_id=:user_id";

		$args = [
			':user_id' => $data['user_id']
		];

		$stmt = DB::run($sql, $args);

		$count = $stmt->rowCount();
		$data = $stmt->fetch();

		$_SESSION['id'] = $data["user_id"];
		$_SESSION['cus_id'] = $data["c_id"];
		$_SESSION['name'] = $data["r_firstname"] . " " . $data["r_lastname"];
		$_SESSION['type'] = 0;
		$_SESSION['status'] = 'active';

		return $count;
	}

	function updateProfileData($id, $fname, $lname, $phone, $address)
	{
		$sql = "update customer_info set c_firstname = :c_firstname, c_lastname = :c_lastname, 
		c_phonenum = :c_phonenum, c_address = :c_address where user_id=:user_id";

		$args = [
			':c_firstname' => $fname,
			':c_lastname' => $lname,
			':c_phonenum' => $phone,
			':c_address' => $address,
			':user_id' => $id
		];

		$stmt = DB::run($sql, $args);
		$count = $stmt->rowCount();

		return $count;
	}
}
