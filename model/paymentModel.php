<?php
require_once ROOT_URL . '/db/database.php';

class PaymentModel
{

	function payTransaction($type)
	{

		$data = array();
		$date = date('Y/m/d H:i:s');

		$payment_amount = $_SESSION['amt'];

		$sql = "insert into payment_data (pd_amt, pd_type, pd_date) VALUES(:pd_amt, :pd_type, :pd_date)";

		$args = [
			':pd_amt' => $payment_amount,
			':pd_type' => $type,
			':pd_date' => $date
		];

		DB::run($sql, $args);

		$sql = "select pd_id from payment_data where pd_date=:pd_date";

		$args = [
			':pd_date' => $date
		];

		$stmt = DB::run($sql, $args);
		$data = $stmt->fetch();
		$pd_id = $data['pd_id'];

		foreach ($_SESSION['cart'] as $key => $value) {

			$sql = "insert into order_data (od_pd_id, od_product_id, od_product_qty, od_status) values(:od_pd_id, :od_product_id, :od_product_qty, :od_status)";

			$args = [
				':od_pd_id' => $pd_id,
				':od_product_id' => $key,
				':od_product_qty' => $value,
				':od_status' => 'Processing'
			];

			DB::run($sql, $args);
			
			$sql = "select product_stock from product where product_id = :product_id";

			$args = [
				':product_id' => $key
			];

			$result = DB::run($sql, $args);
			$data = $result->fetch(PDO::FETCH_ASSOC);

			$data["product_stock"] -= $value;
			if ($data["product_stock"] < 0) {
				$data["product_stock"] = 0;
			}

			$sql = "update product SET product_stock = :product_stock where product_id = :product_id";

			$args = [
				':product_id' => $key,
				':product_stock' => $data["product_stock"]
			];

			DB::run($sql, $args);
		}

		unset($_SESSION['cart']);

		$sql = "select * from order_data where od_pd_id=:od_pd_id";

		$args = [':od_pd_id' => $pd_id];

		$data = DB::run($sql, $args);

		foreach ($data as $row) {

			$sql = "insert into invoice_data (id_pd_id, id_od_id, id_cd_id, id_date) values(:id_pd_id, :id_od_id, :id_cd_id, :id_date)";

			$args = [
				':id_pd_id' => $pd_id,
				':id_od_id' => $row['od_id'],
				':id_cd_id' => $_SESSION['cus_id'],
				':id_date' => $date
			];

			DB::run($sql, $args);
		}

		return true;
	}

	function viewAllOrder()
	{


		$data = array();
		$output = array();

		$sql = "select od_id FROM invoice_data INNER JOIN order_data ON invoice_data.id_od_id = order_data.od_id WHERE invoice_data.id_cd_id=:id_cd_id ORDER BY order_data.od_id DESC";

		$args = [
			':id_cd_id' => $_SESSION['cus_id']
		];

		$data = DB::run($sql, $args);

		foreach ($data as $row) {

			$sql = "select * FROM order_data INNER JOIN product ON order_data.od_product_id = product.product_id WHERE order_data.od_id=:od_id";

			$args = [
				':od_id' => $row['od_id']
			];
			$stmt = DB::run($sql, $args);
			$output[] = $stmt->fetch();
		}

		return $output;
	}
}
