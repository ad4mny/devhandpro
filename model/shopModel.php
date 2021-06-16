<?php
require_once ROOT_URL . '/db/database.php';


class ShopModel {
	
	function shopCatalogView() {
		$sql = "select * from product";
        return DB::run($sql);
	}

	function shopSearchQuery($query) {

		$sql = "select * from product where product_name LIKE '%" . $query . "%'";
		return DB::run($sql);
		
	}


}