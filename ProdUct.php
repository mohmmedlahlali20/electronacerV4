
<?php

class Product {
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
    private $category_id;
    private $disabled;

    public function __construct($product_id, $reference, $image, $barcode, $label, $purchase_price, $final_price, $price_offer, $description, $min_quantity, $stock_quantity, $category_id = null, $disabled = false) {
        $this->product_id = $product_id;
        $this->reference = $reference;
        $this->image = $image;
        $this->barcode = $barcode;
        $this->label = $label;
        $this->purchase_price = $purchase_price;
        $this->final_price = $final_price;
        $this->price_offer = $price_offer;
        $this->description = $description;
        $this->min_quantity = $min_quantity;
        $this->stock_quantity = $stock_quantity;
        $this->category_id = $category_id;
        $this->disabled = $disabled;
    }
      public function gettproduct_id(){
        return $this->product_id;
      }

      public function gettreference(){
        return $this->reference;
      }
      
      public function gettimage(){
        return $this->image;
      }
      public function gettbarcode(){
        return $this->barcode;
      }
      public function gettlabel(){
        return $this->label;
      }

      public function gettpurchase_price(){
        return $this->purchase_price;
      }
      public function gettfinal_price(){
        return $this->final_price;
      }
      public function gettprice_offer(){
        return $this->price_offer;
      }
      public function gettdescription(){
        return $this->description;
      }

      public function gettmin_quantity(){
        return $this->min_quantity;
      }
      public function gettstock_quantity(){
        return $this->stock_quantity;
      }
      public function gettcategory_id(){
        return $this->category_id;
      }

      public function gettdisabled(){
        return $this->disabled;
      }

   
}
