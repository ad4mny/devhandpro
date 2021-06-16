<?php
require_once ROOT_URL . '/model/cartModel.php';

class CheckoutController {

	function viewCart() {

		$cart = new CartModel();
		return $cart->viewCartItem();

	}

	function addCart($id) {

		$cart = new CartModel();
		return $cart->addCartItem($id);

	}

	function deleteCart($id) {

		$cart = new CartModel();
		return $cart->deleteCartItem($id);

	}
}