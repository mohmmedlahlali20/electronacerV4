<?php

class Order {
    private $order_id;
    private $user_id;
    private $order_date;
    private $send_date;
    private $delivery_date;
    private $total_price;
    private $order_status;

    public function __construct($order_id, $user_id, $order_date = null, $send_date = null, $delivery_date = null, $total_price, $order_status = 'Pending') {
        $this->order_id = $order_id;
        $this->user_id = $user_id;
        $this->order_date = $order_date ? $order_date : date('Y-m-d H:i:s');
        $this->send_date = $send_date;
        $this->delivery_date = $delivery_date;
        $this->total_price = $total_price;
        $this->order_status = $order_status;
    }

    public function getOrderId() {
        return $this->order_id;
    }

    public function getUserId() {
        return $this->user_id;
    }

    public function getOrderDate() {
        return $this->order_date;
    }

    public function getSendDate() {
        return $this->send_date;
    }

    public function getDeliveryDate() {
        return $this->delivery_date;
    }

    public function getTotalPrice() {
        return $this->total_price;
    }

    public function getOrderStatus() {
        return $this->order_status;
    }
}
