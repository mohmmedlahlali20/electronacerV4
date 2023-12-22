<?php

require_once 'productsDAO.php';



if (isset($_POST['delete_product'])) {
    if (isset($_POST['product_id'])) {
        $product_id = $_POST['product_id'];

        
        $productDAO = new productDAO();
        
        
        $productDAO-> disaplay_product($product_id);

        header("Location: product_manag.php");
        exit();
    }
}
