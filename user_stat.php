<?php

class UserState {
    private $client_state_id;
    private $user_id;
    private $state;

    public function __construct($client_state_id, $user_id, $state) {
        $this->client_state_id = $client_state_id;
        $this->user_id = $user_id;
        $this->state = $state;
    }

    public function getClientStateId() {
        return $this->client_state_id;
    }

    public function getUserId() {
        return $this->user_id;
    }

    public function getState() {
        return $this->state;
    }
}
