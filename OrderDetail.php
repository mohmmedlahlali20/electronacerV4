<?php

class OrderDetail {
    private $order_detail_id;
    private $user_id;
    private $order_id;
    private $product_id;
    private $quantity;
    private $unit_price;
    private $total_price;

    public function __construct($order_detail_id, $user_id, $order_id, $product_id, $quantity, $unit_price, $total_price) {
        $this->order_detail_id = $order_detail_id;
        $this->user_id = $user_id;
        $this->order_id = $order_id;
        $this->product_id = $product_id;
        $this->quantity = $quantity;
        $this->unit_price = $unit_price;
        $this->total_price = $total_price;
    }

    public function getOrderDetailId() {
        return $this->order_detail_id;
    }

    public function getUserId() {
        return $this->user_id;
    }

    public function getOrderId() {
        return $this->order_id;
    }

    public function getProductId() {
        return $this->product_id;
    }

    public function getQuantity() {
        return $this->quantity;
    }

    public function getUnitPrice() {
        return $this->unit_price;
    }

    public function getTotalPrice() {
        return $this->total_price;
    }
}
