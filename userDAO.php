<?php 
require_once 'connexion.php';
require_once 'user.php';
require_once 'db_config.php';


class fatshingUser
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function get_User()
    {
        $query = "SELECT * FROM users";
        $stmt = $this->db->query($query);
        $stmt->execute();
        $userData = $stmt->fetchAll();
        $Users = array();
        foreach ($userData as $U) {
            $Users[] = new Users(
                $U["user_id"],
                $U["username"],
                $U["email"],
                $U["password"],
                $U["role"],
                $U["verified"],
                $U["full_name"],
                $U["phone_number"],
                $U["address"],
                $U["disabled"],
                $U["city"],
            );
        }
        return $Users;
    }


public function insertUser($Users){
    $query = "UPDATE Users 
            SET username = '{$Users->getUsername()}', 
                email = '{$Users->getEmail()}',
                password = '{$Users->getPassword()}',
                role = {$Users->getRole()},
                verified = {$Users->getVerified()},
                full_name = {$Users->getFull_name()},
                phone_number = {$Users->getPhone_number()},
                address = '{$Users->getAddress()}',
                disabled = {$Users->getDisabled()},
                city = {$Users->getCity()},
                )}
            WHERE reference = {$Users->getUsername()}";
        echo $query;
        $stmt = $this->db->query($query);
        $stmt -> execute();
}
public function update_Users($Users){
    $query = "UPDATE users SET `user_id`='".$Users->getUser_id()."',
     `username` ='".$Users->getUsername()."', 
     email='".$Users->getEmail()."',
     `password`='".$Users->getPassword()."', 
     `verified`='".$Users->getVerified()."',
     `full_name`=".$Users->getFull_name().",
     `phone_number`=".$Users->getPhone_number().",
     `address`=".$Users->getAddress().",
     `city`='".$Users->getCity()."',
    
      WHERE `user_id`= ".$Users->getUser_id();
    echo $query;
    $stmt = $this->db->query($query);
    $stmt -> execute();
}
public function delete_product($id){
    $query = "UPDATE `users`
            SET `verified`= 0
            WHERE `user_id`=" . $id ;
    echo $query;
    $stmt = $this->db->query($query);
    $stmt -> execute();
}


}
$fatshingUser = new fatshingUser();
echo '<pre>';
print_r($fatshingUser->get_User());
echo '</pre>';

// echo '<pre>';
// print_r($fatshingUser->());
// echo '</pre>';

