<?php
require_once ROOT_URL . '/db/database.php';

class adminModel
{
	function viewsp()
	{
		$sql = "select * from serviceprovider_info where sp_status='0'";
		return DB::run($sql);
	}

	function approvalsp()
	{
		$sql = "update serviceprovider_info set sp_status = '1' WHERE sp_id = :sp_id ";
		$args = [':sp_id' => $this->sp_id];
		return DB::run($sql, $args);
	}
}
