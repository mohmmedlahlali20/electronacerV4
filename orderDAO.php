<?php 
require_once  'order.php';
require_once 'connexion.php'; 

class OrderDAO{
    private $db;
    
    public function __construct($db){
        $this->db = $db;
    }

    public function get_order(){
        $query = "SELECT * FROM orders";
        $stmt = $this->db->query($query);
        $stmt->execute();
        $orderData = $stmt->fetchAll();
        $Orders = array();
        foreach ($orderData as $O) {
            $order = new Order(
                $O["order_id"],
                $O["reference"],
                $O["date"],
                $O["total"],
                $O["status"],
                $O["customer_id"],
                $O["product_id"],
                $O["product_quantity"],
                $O["product_price"],
                $O["product_total"],
                $O["product_description"],
            );
            $Orders[] = $order;
    

    }
return $Orders;

}
    public function update_order($order){
        $query = "UPDATE orders 
            SET reference = '{$order->getReference()}', 
                date = '{$order->getDate()}',
                total = '{$order->getTotal()}',
                status = '{$order->getStatus()}',
                customer_id = '{$order->getCustomer_id()}',
                product_id = '{$order->getProduct_id()}',
                product_quantity = '{$order->getProduct_quantity()}',
                product_price = '{$order->getProduct_price()}',
                product_total = '{$order->getProduct_total()}',
                product_description = '{$order->getProduct_description()}'
            WHERE order_id = {$order->getOrder_id()}";
        
        $stmt = $this->db->query($query);
        $stmt -> execute();
    }


public function insert_Order($order){
    $query = "INSERT INTO orders (`order_id`, `reference`, `date`, `total`, `status`, `customer_id`, `product_id`, `product_quantity`, `product_price`, `product_total`, `product_description`) 
                    VALUES ('".$order->getOrder_id()."', '".$order->getReference()."', '".$order->getDate()."', '".$order->getTotal()."', '".$order->getStatus()."', '".$order->getCustomer_id()."', '".$order->getProduct_id()."', '".$order->getProduct_quantity()."', '".$order->getProduct_price()."', '".$order->getProduct_total()."', '".$order->getProduct_description()."')";
                    
    $stmt = $this->db->query($query);
    $stmt->execute();
    return  $query;

}

public function delete_product($id){
    $query = "DELETE FROM orders WHERE 'id' = '".$id."'";
    $stmt = $this->db->query($query);
    $stmt->execute();
    return $query;
}




}