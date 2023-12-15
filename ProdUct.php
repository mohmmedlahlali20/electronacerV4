<?php 
 
    class Product{
        private $product_id;
        private $reference;
        private $image;
        private $barcode;
        private $label;
        private $purchase_price;
        private $final_price;
        private $price_offer;
        private $description;
        private $min_quantity;
        private $stock_quantity;
         private $category;
        private $disabled;

        public function __construct($product_id, $reference, $image, $barcode, $label, $purchase_price, $final_price , $price_offer , $description , $min_quantity ,$stock_quantity ,$category, $disabled)
{
            $this->product_id = $product_id;
            $this->reference = $reference;
            $this->image = $image;
            $this->barcode = $barcode;
            $this->label = $label;
            $this->purchase_price= $purchase_price;
            $this->final_price = $final_price;
            $this->price_offer = $price_offer;
            $this->description = $description;
            $this->min_quantity = $$min_quantity;
            $this->stock_quantity = $stock_quantity;
            $this->category = $category;
            $this->disabled = $disabled;
           
}
        /**
         * Get the value of product_id
         */ 
        public function getProduct_id(){
        {
                return $this->product_id;
        }
        }

        /**
         * Get the value of reference
         */ 
        public function getReference()
        {
                return $this->reference;
        }
    }