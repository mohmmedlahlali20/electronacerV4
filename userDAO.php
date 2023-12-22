
<?php
require_once 'connex_db.php';
require_once 'users.php';

class UserDAO{
    private $db;
  
    public function __construct(){
      $this->db = Database::getInstance()->gettconnection();
    } 
public function get_user_by_id($id){
    $query="SELECT * FROM users where user_id ='$id' ";
    $stmt = $this->db->query($query);
    $stmt->execute();
    $result = $stmt->fetch();
    return $result;
}
public function get_users(){
    $query = "SELECT * FROM users ";
    $stmt = $this->db->query($query);
    $stmt -> execute();
    $usersData = $stmt->fetchAll();
    $userss = array();
    foreach ( $usersData as $usr) {
        $userss[] = new User($usr["user_id"],$usr["username"],$usr["email"], $usr["password"],$usr["role"], $usr["verified"],$usr["full_name"], $usr["phone_number"],$usr["address"], $usr["disabled"], $usr["city"]);
    }
    return $userss;

}
public function get_chaked_user($email , $password ){

    $query = "SELECT * FROM Users WHERE email = '$email' AND password = '$password' AND disabled = 0";
    $stmt = $this->db->query($query);
    $stmt->execute();
    $result = $stmt->fetch();
    return $result;
}

public function insert_users($User){
    $query="INSERT INTO users VALUES (0, '".$User->getUsername()."','".$User-> getEmail()."', '".$User-> getPassword()."','".$User->getRole()."','".$User-> isVerified()."','".$User->getFullName()."','".$User-> getPhoneNumber()."','".$User->getAddress()."','".$User-> isDisabled()."','".$User->getCity()."') ";
    $result= $stmt = $this->db->query($query);
    
    return $result;
  



}
public function delet_user($id){
    $query = "DELETE FROM  users  WHERE user_id=" . $id ;
    $stmt = $this->db->query($query);
    $stmt -> execute();
}
public function verify_user($id){
    $query = "UPDATE users SET disabled = 1 WHERE user_id=" . $id ;
    $stmt = $this->db->query($query);
    $stmt -> execute();
}


public function updat_users( $user , $id){
    $query="UPDATE users  set user_id='".$user->getUserId()."', username='".$user-> getUsername()."',email='".$user->getEmail()."', password='".$user-> getPassword()."',       role='".$user->getRole()."', verified='".$user-> isVerified()."',full_name='".$user->getFullName()."', phone_number='".$user-> getPhoneNumber()."',      address='".$user-> getAddress()."',disabled='".$user->isDisabled()."', city='".$user-> getCity()."' WHERE user_id = '$id'"  ;
    $stmt = $this->db->query($query);
    $stmt -> execute();
}

// Add methods for insert, update, delete operations if needed
}
