<?php
require_once ROOT_URL . '/model/serviceModel.php';

class ServiceController {

    function readyOrder($id){
        $order = new ServiceModel();
        header('Location: order_panel');
        return $order->readyOrder($id);
    }

    function deleteOrder($id){
        $order = new ServiceModel();
        header('Location: order_panel');
        return $order->deleteOrder($id);
    }

    function viewAllOrder(){
        $order = new ServiceModel();
        return $order->viewAllOrder();
    }

    function viewRequestOrder($id){
        $order = new ServiceModel();
        return $order->viewRequestOrder($id);
    }

    function viewReadyOrder($id){
        $order = new ServiceModel();
        return $order->viewReadyOrder($id);
    }

    function viewStat($id){
        $order = new ServiceModel();
        return $order->viewStatData($id);
    }

    function viewAllProduct($id){
        $product = new ServiceModel();
        return $product->viewAllProduct($id);
    }

    function addProduct(){

        $product = new ServiceModel();
        $product->product_name = $_POST['product_name'];
        $product->product_category = $_POST['product_category'];
        $product->product_price = $_POST['product_price'];
        $product->product_desc = $_POST['product_desc'];
        $product->product_stock = $_POST['product_stock'];
        $product->product_image = $_POST['product_image'];

        if($product->addNewProduct() > 0){

            header('Location: catalog_panel');
        }
    }
    
    function viewProduct($id){
        $product = new ServiceModel();
        return $product->viewProduct($id);
    }
    
    function updateProduct($id){
        $product = new ServiceModel();
        $product->product_id = $id;
        $product->product_name = $_POST['product_name'];
        $product->product_category = $_POST['product_category'];
        $product->product_price = $_POST['product_price'];
        $product->product_desc = $_POST['product_desc'];
        $product->product_stock = $_POST['product_stock'];
        $product->product_image = $_POST['product_image'];

        if($product->updateProduct() > 0){

            header('Location: catalog_panel');
        }
    }
    
    function deleteProduct($id){

        $product = new ServiceModel();
        $product->product_id = $id;

        if($product->deleteProduct() > 0){

            header('Location: catalog_panel');
        }
    }
}

?>
