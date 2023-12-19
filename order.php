<?php 

require_once 'connexion.php'; 

class Order {
    private $order_id;
    private $reference;
    private $date;
    private $total;
    private $status;
    private $customer_id;
    private $product_id;
    private $product_quantity;
    private $product_price;
    private $product_total;
    private $product_description;

    public function __construct($order_id, $reference, $date, $total, $status, $customer_id, $product_id, $product_quantity, $product_price, $product_total, $product_description){
        $this->order_id = $order_id;
        $this->reference = $reference;
        $this->date = $date;
        $this->total = $total;
        $this->status = $status;
        $this->customer_id = $customer_id;
        $this->product_id = $product_id;
        $this->product_quantity = $product_quantity;
        $this->product_price = $product_price;
        $this->product_total = $product_total;
        $this->product_description = $product_description;

    }
    
    public function getOrder_id(){
        return $this->order_id;
    }
    
    public function setOrder_id($order_id){
        $this->order_id = $order_id;
    }
    
    public function getReference(){
        return $this->reference;
    }
    
    public function setReference($reference){
        $this->reference = $reference;
    }
    
    public function getDate(){
        return $this->date;
    }

    public function setDate($date){
        $this->date = $date;
    }
    
    public function getTotal(){
        return $this->total;
    }
    
    public function setTotal($total){
        $this->total = $total;
    }
    
    public function getStatus(){
        return $this->status;
    }
    
    public function setStatus($status){
        $this->status = $status;
    }
    
    public function getCustomer_id(){
        return $this->customer_id;
    }
    
    public function setCustomer_id($customer_id){
        $this->customer_id = $customer_id;
    }
    
    public function getProduct_id(){
        return $this->product_id;
    }

    public function setProduct_id($product_id){
        $this->product_id = $product_id;
    }
    
    public function getProduct_quantity(){
        return $this->product_quantity;
    }
    
    public function setProduct_quantity($product_quantity){
        $this->product_quantity = $product_quantity;
    }
    
    public function getProduct_price(){
        return $this->product_price;
    }
    
    public function setProduct_price($product_price){
        $this->product_price = $product_price;
    }
    
    public function getProduct_total(){
        return $this->product_total;
    }

    public function setProduct_total($product_total){
        $this->product_total = $product_total;
    }
    
    public function getProduct_description(){
        return $this->product_description;
    }

    public function setProduct_description($product_description){
        $this->product_description = $product_description;
    }
    



}