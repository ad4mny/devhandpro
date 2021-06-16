<?php
require_once ROOT_URL . '/model/paymentModel.php';

class PaymentController
{

	function addTransaction($type)
	{
		$pay = new PaymentModel();
		$res = $pay->payTransaction($type);
		if ($res === true) {
			header("Location: payment?act=payment&flag=success");
		}
	}

	function viewAllOrder()
	{

		$order = new PaymentModel();
		return $order->viewAllOrder();
	}
}
