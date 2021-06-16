<?php
require_once ROOT_URL . '/db/database.php';

class CartModel
{

	function viewCartItem()
	{

		$data = array();
		if (isset($_SESSION['cart'])) {
			foreach ($_SESSION['cart'] as $key => $value) {
				$data[] = $key;
			}
		}
		$array = "'" . implode("','", $data) . "'";

		$sql = "select * from product where product_id IN ($array)";
		return DB::run($sql);
	}

	function addCartItem($id)
	{

		$_SESSION['cart'][$id] += 1;
		return true;
	}

	function deleteCartItem($id)
	{

		$_SESSION['cart'][$id] -= 1;

		if ($_SESSION['cart'][$id] == 0) {
			unset($_SESSION['cart'][$id]);
		}

		return true;
	}
}
