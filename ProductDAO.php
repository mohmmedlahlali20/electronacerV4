<?php
require_once 'connexion.php';
require_once 'ProdUct.php';
require_once 'db_config.php';
class fetchingdata {
    private $db;


    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }
 
    public function get_product(){
        $query = "SELECT * FROM products";
        $stmt = $this->db->query($query);
        $stmt->execute();
        $productData = $stmt->fetchAll();
        $Products = array();
    
        foreach ($productData as $P) {
            $product = new Product(
                $P["product_id"],
                $P["reference"],
                $P["image"],
                $P["barcode"],
                $P["label"],
                $P["purchase_price"],
                $P["final_price"],
                $P["price_offer"],
                $P["description"],
                $P["min_quantity"],
                $P["stock_quantity"],
                $P["category_id"],
                $P["disabled"],
               
            );
    
            $Products[] = $product;
        }
    
        return $Products;
    }
    
    public function UPDATE_Product($Products){
        $query = "UPDATE products 
          SET reference = '{$Products->getReference()}', 
              image = '{$Products->getImage()}',
              productname = '{$Products->getProductname()}',
              barcode = {$Products->getBarcode()},
              purchase_price = {$Products->getPurchase_price()},
              final_price = {$Products->getFinal_price()},
              price_offer = {$Products->getPrice_offer()},
              descrip = '{$Products->getDescrip()}',
              min_quantity = {$Products->getMin_quantity()},
              stock_quantity = {$Products->getStock_quantity()},
              category_id = '{$Products->getCategory_id()}',
              bl = {$Products->getBl()}
          WHERE reference = {$Products->getReference()}";
        
        $stmt = $this->db->query($query);
        $stmt -> execute();

    }

   

    public function Insert_Product($Product) {
        $query = "INSERT INTO products (`product_id`, `reference`, `image`, `barcode`, `label`, `purchase_price`, `final_price`, `price_offer`, `description`, `min_quantity`, `stock_quantity`, `category_id`, `disabled`) 
                    VALUES ('".$Product->getProduct_id()."', '".$Product->getReference()."', '".$Product->getImage()."', '".$Product->getBarcode()."', '".$Product->getLabel()."', ".$Product->getPurchase_price().", ".$Product->getFinal_price().", ".$Product->getPrice_offer().", '".$Product->getDescription()."', ".$Product->getMin_quantity().", ".$Product->getStock_quantity().", '".$Product->getCategory_id()."', ".$Product->getDisabled().")";
        

        $stmt = $this->db->query($query);
        $stmt->execute();
        return  $query;
    }
    public function Delete_Product($id){
        $query = "delete from products where  'id' = '$id' ";
       
        $stmt = $this->db->query($query);
        $stmt -> execute();
    }

    




}
