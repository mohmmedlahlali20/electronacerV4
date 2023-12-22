<?php
require_once 'connex_db.php';
require_once 'category.php';
class categoryDAO{
  private $db;

  public function __construct(){
    $this->db = Database::getInstance()->gettconnection();
  } 
  public function getCategoryById($category_id){
    $query = "SELECT * FROM categories WHERE category_id ='$category_id' ";
    $stmt = $this->db->query($query);
    $stmt->execute();
    $result = $stmt->fetch();
    return $result;
}


    
  public function get_categorys(){
    $query = "SELECT * FROM categories where is_desaybelsd =0";
    $stmt = $this->db->query($query);
    $stmt -> execute();
    $categorysData = $stmt->fetchAll();
    $categorys = array();
    foreach ( $categorysData as $cat) {
        $categorys[] = new Category($cat["category_id"],$cat["category_name"],$cat["imag_category"], $cat["is_desaybelsd"]);
    }
    return $categorys;

}
  public function insert_category($category){
    $query="INSERT INTO categories VALUES (0, '".$category->getCategoryName()."','".$category-> getImageCategory()."', '".$category-> isDisabled()."')  ";
    $stmt = $this->db->query($query);
      
}
public function updat_category( $category , $id){
       $query="UPDATE categories set category_name='".$category->getCategoryName()."', imag_category='".$category-> getImageCategory()."' WHERE category_id = '$id'"  ;
       $stmt = $this->db->query($query);
       $stmt -> execute();
}
public function disaplay_category($id){
    $query = "UPDATE categories SET is_desaybelsd = 1 WHERE category_id=" . $id ;
    $stmt = $this->db->query($query);
    $stmt -> execute();
}
public function delet_category($id){
    $query = "DELETE FROM categories  WHERE category_id=" . $id ;
    $stmt = $this->db->query($query);
    $stmt -> execute();
}

}

