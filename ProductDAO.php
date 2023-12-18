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
    
    public function insert_product($Products){
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
        echo $query;
        $stmt = $this->db->query($query);
        $stmt -> execute();

    }

    public function update_product($Product){
        $query = "UPDATE products SET `product_id`='".$Product->getProduct_id()."' `reference` ='".$Product->getReference()."', ìmage='".$Product->getImage()."',`barcode`='".$Product->getBarcode."', `label`='".$Product->getLabel()."',`purchase_price`=".$Product->getPurchase_price().",`final_price`=".$Product->getFinal_price().",`price_offer`=".$Product->getPrice_offer().",`description`='".$Product->getDescription()."',`min_quantity`=".$Product->getMin_quantity().",`stock_quantity`=".$Product->getStock_quantity().",`category_id`='".$Product->getCategory_id()."',`disabled`=".$Product->getDisabled()." WHERE `reference`= ".$Product->getReference();
        echo $query;
        $stmt = $this->db->query($query);
        $stmt -> execute();
    }
    public function delete_product($id){
        $query = "UPDATE `products` SET `bl`= 0 WHERE `reference`=" . $id ;
        echo $query;
        $stmt = $this->db->query($query);
        $stmt -> execute();
    }

    




}
$fetchingdata = new fetchingdata();
echo '<pre>';
print_r($fetchingdata->get_product());
echo '</pre>';
