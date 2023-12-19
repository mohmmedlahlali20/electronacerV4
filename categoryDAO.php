<?php 
require_once  'category.php';
require_once 'connexion.php';   
class CategoryDAO{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }
   
    public function selectData( $columns = '*',$tableName, $where = '') {
        try {
            $sql = "SELECT $columns FROM $tableName";
            if (!empty($where)) {
                $sql .= " WHERE $where";
            }
            $result = $this->db->query($sql);

            $rows = $result->fetchAll(PDO::FETCH_ASSOC);

            return $rows;
        } catch (PDOException $e) {
            echo "Selection failed: " . $e->getMessage();
            return false;
        }
    }
public function insertCategory($Category) {
    $query = "INSERT INTO Categories (category_name, imag_category, is_desaybelsd) VALUES (?, ?, ?)";

    $stmt = $this->db->prepare($query);

    $categoryName = $Category->getCategory_name();
    $imagCategory = $Category->getImag_category();
    $isDesaybelsd = $Category->getIs_desaybelsd();

    // Bind parameters
    $stmt->bindParam(1, $categoryName);
    $stmt->bindParam(2, $imagCategory);
    $stmt->bindParam(3, $isDesaybelsd);
    try {
        $stmt->execute();

        $lastInsertId = $this->db->lastInsertId();

        return $lastInsertId;
    } catch (Exception $e) {
        // Handle database insertion failure
        error_log('Database insertion error: ' . $e->getMessage());
        return false;
    } finally {
        $stmt->closeCursor();
    }
}

    
    
public function delete_category($id){
  
    $query ="UPDATE Categories SET is_desaybelsd = TRUE WHERE category_id = $id";
    $stmt = $this->db->prepare($query);
    $stmt->execute();
}



}