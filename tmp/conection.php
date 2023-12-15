<?php  

class database{
    private $dsn ="mysql:host=localhost;dbname=electronacerV4";
    private $user = "root";
    private $pass = "";
    public $conn;
    public function __construct(){
        try{
            $this->conn = new PDO($this->dsn, $this->user, $this->pass);
        }
        catch(PDOException $e){
            echo "Error: ". $e->getMessage();
        }
    }

public function insert($username, $email ,$password, $fullname, $phone_number, $address , $city  ){
    $sql = "INSERT INTO users (username, email, password, fullname, phone_number, address, city) VALUES (:username, :email, :password, :fullname, :phone_number, :address, :city)";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":password", $password);
    $stmt->bindParam(":fullname", $fullname);
    $stmt->bindParam(":phone_number", $phone_number);
    $stmt->bindParam(":address", $address);
    $stmt->bindParam(":city", $city);
    $stmt->execute();
    return true ;
}
public function read() {
    $sql = "SELECT * FROM users";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $data = array();
    foreach ($result as $row) {
        $data[] =  $row;
    }

    return $data;
}
public function getUserById($id) {
    $sql="SELECT * FROM users WHERE id = :id";
    $stmt = $this->conn->prepare($sql);
    // $stmt->bindParam(":id", $id);
    $stmt->execute([':id' => $id]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}
public function update($username, $email ,$password, $fullname, $phone_number, $address , $city ) {
    $sql = "UPDATE users SET username = :username, email = :email, password = :password, fullname = :fullname, phone_number = :phone_number, address = :address, city = :city WHERE id = :id";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":password", $password);
    $stmt->bindParam(":fullname", $fullname);
    $stmt->bindParam(":phone_number", $phone_number);
    $stmt->bindParam(":address", $address);
    $stmt->bindParam(":city", $city);
    $stmt->bindParam(":id", $id);
    $stmt->execute(['username' => $username,'email' => $email,'fullname' => $fullname,'phone_number' => $phone_number,'address' => $address,'city'=>$city]);
    return true;

}
public function delete($id){
    $sql="DELETE FROM users WHERE id = :id";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(":id", $id);
    $stmt->execute(['id' => $id]);
    return true;
}
public function totalRowCount(){
    $sql = "SELECT * FROM users";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    $t_rows = $stmt->rowCount();
    
    return $t_rows;
}
}
$ob = new Database();
echo  $ob->totalRowCount();

// $result = $ob->read();
// print_r($result);


?>
