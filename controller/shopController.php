<?php
require_once ROOT_URL . '/model/shopModel.php';

class ShopController {

	function shopBrowse() {

		$browse = new ShopModel();
		return $browse->shopCatalogView();

	}

	function shopSearch($query) {

		$browse = new ShopModel();
		return $browse->shopSearchQuery($query);

	}

}