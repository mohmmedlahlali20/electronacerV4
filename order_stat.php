<?php

class OrderState {
    private $order_state_id;
    private $order_id;
    private $state;

    public function __construct($order_state_id, $order_id, $state) {
        $this->order_state_id = $order_state_id;
        $this->order_id = $order_id;
        $this->state = $state;
    }

    public function getOrderStateId() {
        return $this->order_state_id;
    }

    public function getOrderId() {
        return $this->order_id;
    }

    public function getState() {
        return $this->state;
    }
}
