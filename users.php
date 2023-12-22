<?php


class User {
    private $user_id;
    private $username;
    private $email;
    private $password;
    private $role;
    private $verified;
    private $full_name;
    private $phone_number;
    private $address;
    private $disabled;
    private $city;

    public function __construct($user_id, $username, $email, $password, $role, $verified = false, $full_name, $phone_number, $address , $disabled = false, $city) {
        $this->user_id = $user_id;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
        $this->verified = $verified;
        $this->full_name = $full_name;
        $this->phone_number = $phone_number;
        $this->address = $address;
        $this->disabled = $disabled;
        $this->city = $city;
    }

    public function getUserId() {
        return $this->user_id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getRole() {
        return $this->role;
    }

    public function isVerified() {
        return $this->verified;
    }

    public function getFullName() {
        return $this->full_name;
    }

    public function getPhoneNumber() {
        return $this->phone_number;
    }

    public function getAddress() {
        return $this->address;
    }

    public function isDisabled() {
        return $this->disabled;
    }

    public function getCity() {
        return $this->city;
    }
}
