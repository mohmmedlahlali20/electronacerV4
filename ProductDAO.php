<?php
require_once 'connexion.php';
require_once 'ProdUct.php';
class ProductDAO{
    private $db;
    public function __construct(){
        $this->db = Database::getInstance()->getConnection(); 
    }

    public function get_Product(){
        $query = "SELECT * FROM products";
        $stmt = $this->db->query($query);
        $stmt -> execute();
        $ProductData = $stmt->fetchAll();
        $Books = array();
        foreach ($ProductData as $B) {
            $Books[] = new product($B["product_id"],$B["reference"],$B["image"], $B["barcode"],$B["Price"],$B["label"],$B["purchase_price"],$B["final_price"],$B["price_offer"],$B["description"],$B["min_quantity"],$B["stock_quantity"],$B["category_id"],$B["disabled"]);
        }
        return $Books;
       

    }

}



?>