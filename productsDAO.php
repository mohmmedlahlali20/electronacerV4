<?php
require_once 'connex_db.php';
require_once 'product.php';
class ProductDAO {
    private $db;

    public function __construct(){
        $this->db = Database::getInstance()-> gettconnection();
    }
    public function getProductById($product_id){
        $query = "SELECT * FROM products WHERE product_id ='$product_id' ";
        $stmt = $this->db->query($query);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }
    public function getProducts(){
        $query = "SELECT * FROM products where disabled =0";
    $stmt = $this->db->query($query);
    $stmt -> execute();
    $productsData = $stmt->fetchAll();
    $products = array();
    foreach ( $productsData as $pro) {
        $products[] = new Product($pro["product_id"],$pro["reference"],$pro["image"],$pro["barcode"], $pro["label"],$pro["purchase_price"],$pro["final_price"],$pro["price_offer"], $pro["description"],$pro["min_quantity"], $pro["stock_quantity"],$pro["category_id"]);
    }
    
        return $products;
    }
    public function disaplay_product($id){
        $query = "UPDATE products SET disabled = 1 WHERE product_id=" . $id ;
        $stmt = $this->db->query($query);
        $stmt -> execute();
    }
    public function updat_product( $product , $id){
        $query="UPDATE products  set reference='".$product->gettreference()."', image='".$product-> gettimage()."',barcode='".$product->gettbarcode()."', label='".$product-> gettlabel()."',       purchase_price='".$product->gettpurchase_price()."', final_price='".$product-> gettfinal_price()."',price_offer='".$product->gettprice_offer()."', description='".$product-> gettdescription()."',      min_quantity='".$product-> gettmin_quantity()."',stock_quantity='".$product->gettstock_quantity()."', category_id='".$product-> gettcategory_id()."' WHERE product_id = '$id'"  ;
        $stmt = $this->db->query($query);
        $stmt -> execute();
 }

    // Add methods for insert, update, delete operations if needed
}

?>
