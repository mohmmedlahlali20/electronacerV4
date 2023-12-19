<?php

require_once 'connexion.php';
require_once 'user.php';

class UserDAO
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function select_Users($tableName, $columns = '*', $where = '')
    {
        try {
            $sql = "SELECT $columns FROM $tableName";
            
            if (!empty($where)) {
                $sql .= " WHERE $where";
            }
    
            $stmt = $this->db->query($sql);
            $stmt->execute();
            $userData = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            $users = [];
    
            foreach ($userData as $user) {
                $users[] = new Users(
                    $user["user_id"],
                    $user["username"],
                    $user["email"],
                    $user["password"],
                    $user["role"],
                    $user["verified"],
                    $user["full_name"],
                    $user["phone_number"],
                    $user["address"],
                    $user["disabled"],
                    $user["city"]
                );
            }
    
            return $users;
        } catch (PDOException $e) {
            echo "Selection failed: " . $e->getMessage();
            return false;
        }
    }
    
    
        public function insertUser($user)
        {
            $query = "INSERT INTO Users 
                (username, email, password, role, verified, full_name, phone_number, address, disabled, city)
                VALUES 
                (:username, :email, :password, :role, :verified, :full_name, :phone_number, :address, :disabled, :city)";
    
            $stmt = $this->db->prepare($query);
    
            $stmt->bindValue(':username', $user->getUsername());
            $stmt->bindValue(':email', $user->getEmail());
            $stmt->bindValue(':password', $user->getPassword());
            $stmt->bindValue(':role', $user->getRole());
            $stmt->bindValue(':verified', $user->getVerified());
            $stmt->bindValue(':full_name', $user->getFull_name());
            $stmt->bindValue(':phone_number', $user->getPhone_number());
            $stmt->bindValue(':address', $user->getAddress());
            $stmt->bindValue(':disabled', $user->getDisabled());
            $stmt->bindValue(':city', $user->getCity());
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
    

    public function updateUsers($user)
    {
        $query = "UPDATE users SET 
            `username`=:username, 
            `email`=:email,
            `password`=:password, 
            `verified`=:verified,
            `full_name`=:full_name,
            `phone_number`=:phone_number,
            `address`=:address,
            `city`=:city
            WHERE `user_id`=:user_id";

        $stmt = $this->db->prepare($query);

        $stmt->bindValue(':username', $user->getUsername());
        $stmt->bindValue(':email', $user->getEmail());
        $stmt->bindValue(':password', $user->getPassword());
        $stmt->bindValue(':verified', $user->getVerified());
        $stmt->bindValue(':full_name', $user->getFull_name());
        $stmt->bindValue(':phone_number', $user->getPhone_number());
        $stmt->bindValue(':address', $user->getAddress());
        $stmt->bindValue(':city', $user->getCity());
        $stmt->bindValue(':user_id', $user->getUser_id());

        $stmt->execute();
    }

    public function deleteUser($id)
{
    $query = "DELETE FROM users WHERE `user_id` = :user_id";

    $stmt = $this->db->prepare($query);
    $stmt->bindValue(':user_id', $id);
    
}

}
