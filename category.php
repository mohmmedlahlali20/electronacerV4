<?php

class Category {
    private $category_id;
    private $category_name;
    private $image_category;
    private $is_disabled;

    public function __construct($category_id, $category_name, $image_category, $is_disabled = false) {
        $this->category_id = $category_id;
        $this->category_name = $category_name;
        $this->image_category = $image_category;
        $this->is_disabled = $is_disabled;
    }

    public function getCategoryId() {
        return $this->category_id;
    }

    public function getCategoryName() {
        return $this->category_name;
    }

    public function getImageCategory() {
        return $this->image_category;
    }

    public function isDisabled() {
        return $this->is_disabled;
    }
}
