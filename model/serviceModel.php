<?php
error_reporting("0");
require_once ROOT_URL . '/db/database.php';

class ServiceModel
{

	public $product_id, $product_name, $product_category, $product_price, $product_desc, $product_stock, $product_image, $product_quantity;

	function readyOrder($id)
	{
		$sql = "update order_data SET od_status='Ready' WHERE od_id=:od_id";
		$args = [':od_id' => $id];
		return DB::run($sql, $args);
	}

	function deleteOrder($id)
	{
		$sql = "begin;
		delete FROM invoice_data WHERE id_od_id=:id_od_id;
		delete FROM order_data WHERE od_id=:od_id;
		commit";
		$args = [
			':id_od_id' => $id,
			':od_id' => $id
		];
		return DB::run($sql, $args);
	}

	function viewAllOrder()
	{
		$sql = "select * FROM product INNER JOIN order_data ON product.product_id = order_data.od_product_id WHERE 
		product.sp_id=:sp_id";
		$args = [':sp_id' => $_SESSION['com_id']];
		return DB::run($sql, $args);
	}

	function viewRequestOrder($id)
	{
		$sql = "select * FROM product INNER JOIN order_data ON product.product_id = order_data.od_product_id WHERE 
		order_data.od_status=:od_status AND product.sp_id=:sp_id";
		$args = [
			':od_status' => 'Processing',
			':sp_id' => $id
		];
		return DB::run($sql, $args);
	}

	function viewReadyOrder($id)
	{
		$sql = "select * FROM product INNER JOIN order_data ON product.product_id = order_data.od_product_id WHERE 
		order_data.od_status=:od_status AND product.sp_id=:sp_id";
		$args = [
			':od_status' => 'Ready',
			':sp_id' => $id
		];
		return DB::run($sql, $args);
	}

	function viewStatData($id)
	{
		$data = array();
		$sql = "select * from product JOIN order_data ON product.product_id = order_data.od_product_id WHERE 
		order_data.od_status=:od_status AND product.sp_id=:sp_id";
		$args = [
			':od_status' => 'Ready',
			':sp_id' => $id
		];
		$data['ready'] = DB::run($sql, $args)->rowCount();

		$sql = "select * from product JOIN order_data ON product.product_id = order_data.od_product_id WHERE 
		order_data.od_status=:od_status AND product.sp_id=:sp_id";
		$args = [
			':od_status' => 'Processing',
			':sp_id' => $id
		];
		$data['processing'] = DB::run($sql, $args)->rowCount();

		return $data;
	}

	function viewAllProduct($id)
	{
		$sql = "select * from product where sp_id=:sp_id";
		$args = [':sp_id' => $id];
		return DB::run($sql, $args);
	}

	function addNewProduct()
	{

		$updir = '/view/bootstrap/upload/catalog/';
		$fileName = $updir . $_FILES['product_image']['name'];

		$sql = "insert into product(sp_id, product_type, product_name, product_category, product_price, 
		product_desc, product_stock, product_image) values(:sp_id, :product_type, :product_name, 
		:product_category, :product_price, :product_desc, :product_stock, :product_image)";

		$args = [
			':sp_id' => $_SESSION['com_id'],
			':product_type' => $_SESSION['service'],
			':product_name' => $this->product_name,
			':product_category' => $this->product_category,
			':product_price' => $this->product_price,
			':product_desc' => $this->product_desc,
			':product_stock' => $this->product_stock,
			':product_image' => $fileName
		];

		move_uploaded_file($_FILES['product_image']['tmp_name'], ROOT_URL . $fileName);

		$stmt = DB::run($sql, $args);
		$count = $stmt->rowCount();
		return $count;
	}

	function viewProduct($id)
	{
		$sql = "select * from product where product_id=:product_id and sp_id=:sp_id";
		$args = [
			':product_id' => $id,
			':sp_id' => $_SESSION['com_id']
		];
		return DB::run($sql, $args);
	}


	function updateProduct()
	{

		if (!empty($_FILES['product_image']['name'])) {


			$updir = '/view/bootstrap/upload/catalog/';

			$fileName = $updir . $_FILES['product_image']['name'];

			$sql = "update product set product_type=:product_type, product_name=:product_name, product_category=:product_category, product_price=:product_price, product_desc=:product_desc, product_stock=:product_stock, product_image=:product_image where product_id=:product_id";

			$args = [
				':product_id' => $this->product_id,
				':product_type' => $_SESSION['service'],
				':product_name' => $this->product_name,
				':product_category' => $this->product_category,
				':product_price' => $this->product_price,
				':product_desc' => $this->product_desc,
				':product_stock' => $this->product_stock,
				':product_image' => $fileName
			];

			move_uploaded_file($_FILES['product_image']['tmp_name'], ROOT_URL . $fileName);
		} else {

			$sql = "update product set product_type=:product_type, product_name=:product_name, product_category=:product_category, product_price=:product_price, product_desc=:product_desc, product_stock=:product_stock where product_id=:product_id";

			$args = [
				':product_id' => $this->product_id,
				':product_type' => $_SESSION['service'],
				':product_name' => $this->product_name,
				':product_category' => $this->product_category,
				':product_price' => $this->product_price,
				':product_desc' => $this->product_desc,
				':product_stock' => $this->product_stock
			];
		}

		return DB::run($sql, $args);
	}

	function deleteProduct()
	{

		$sql = "select product_image from product where product_id=:product_id and sp_id=:sp_id";
		$args = [
			':product_id' => $this->product_id,
			':sp_id' => $_SESSION['com_id']
		];

		$stmt = DB::run($sql, $args);
		$count = $stmt->rowCount();
		$data = $stmt->fetch();

		$sql = "delete from order_data where od_product_id=:product_id";
		$args = [':product_id' => $this->product_id];


		$sql = "delete from product where product_id=:product_id";
		$args = [':product_id' => $this->product_id];

		DB::run($sql, $args);
		if ($data['product_image'] != null) {
			unlink('../../view/' . $data['product_image']);
		}

		return $count;
	}
}
