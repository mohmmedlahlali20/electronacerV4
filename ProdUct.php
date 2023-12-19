<?php 
 include 'connexion.php';
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
        private $category_id;
        private $disabled;

        public function __construct($product_id, $reference, $image, $barcode, $label, $purchase_price, $final_price , $price_offer , $description , $min_quantity ,$stock_quantity ,$category_id, $disabled)
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
                $this->min_quantity = $min_quantity;
                $this->stock_quantity = $stock_quantity;
                $this->category_id = $category_id;
                $this->disabled = $disabled;
                
}

        

        /**
         * Get the value of product_id
         */ 
        public function getProduct_id()
        {
                return $this->product_id;
        }

        /**
         * Set the value of product_id
         *
         * @return  self
         */ 
        public function setProduct_id($product_id)
        {
                $this->product_id = $product_id;

                return $this;
        }

        /**
         * Get the value of reference
         */ 
        public function getReference()
        {
                return $this->reference;
        }

        /**
         * Set the value of reference
         *
         * @return  self
         */ 
        
        public function setReference($reference)
        {
                $this->reference = $reference;

                return $this;
        }

        /**
         * Get the value of image
         */ 
        public function getImage()
        {
                return $this->image;
        }

        /**
         * Set the value of image
         *
         * @return  self
         */ 
        public function setImage($image)
        {
                $this->image = $image;

                return $this;
        }

        /**
         * Get the value of barcode
         */ 
        public function getBarcode()
        {
                return $this->barcode;
        }

        /**
         * Set the value of barcode
         *
         * @return  self
         */ 
        public function setBarcode($barcode)
        {
                $this->barcode = $barcode;

                return $this;
        }

        /**
         * Get the value of label
         */ 
        public function getLabel()
        {
                return $this->label;
        }

        /**
         * Set the value of label
         *
         * @return  self
         */ 
        public function setLabel($label)
        {
                $this->label = $label;

                return $this;
        }

        /**
         * Get the value of purchase_price
         */ 
        public function getPurchase_price()
        {
                return $this->purchase_price;
        }

        /**
         * Set the value of purchase_price
         *
         * @return  self
         */ 
        public function setPurchase_price($purchase_price)
        {
                $this->purchase_price = $purchase_price;

                return $this;
        }

        /**
         * Get the value of final_price
         */ 
        public function getFinal_price()
        {
                return $this->final_price;
        }

        /**
         * Set the value of final_price
         *
         * @return  self
         */ 
        public function setFinal_price($final_price)
        {
                $this->final_price = $final_price;

                return $this;
        }

        /**
         * Get the value of price_offer
         */ 
        public function getPrice_offer()
        {
                return $this->price_offer;
        }

        /**
         * Set the value of price_offer
         *
         * @return  self
         */ 
        public function setPrice_offer($price_offer)
        {
                $this->price_offer = $price_offer;

                return $this;
        }

        /**
         * Get the value of description
         */ 
        public function getDescription()
        {
                return $this->description;
        }

        /**
         * Set the value of description
         *
         * @return  self
         */ 
        public function setDescription($description)
        {
                $this->description = $description;

                return $this;
        }

        /**
         * Get the value of min_quantity
         */ 
        public function getMin_quantity()
        {
                return $this->min_quantity;
        }

        /**
         * Set the value of min_quantity
         *
         * @return  self
         */ 
        public function setMin_quantity($min_quantity)
        {
                $this->min_quantity = $min_quantity;

                return $this;
        }

        /**
         * Get the value of stock_quantity
         */ 
        public function getStock_quantity()
        {
                return $this->stock_quantity;
        }

        /**
         * Set the value of stock_quantity
         *
         * @return  self
         */ 
        public function setStock_quantity($stock_quantity)
        {
                $this->stock_quantity = $stock_quantity;

                return $this;
        }

         /**
          * Get the value of category
          */ 
         public function getCategory()
         {
                  return $this->category_id;
         }

         /**
          * Set the value of category
          *
          * @return  self
          */ 
         public function setCategory($category_id)
         {
                  $this->category_id= $category_id;

                  return $this;
         }

        /**
         * Get the value of disabled
         */ 
        public function getDisabled()
        {
                return $this->disabled;
        }

        /**
         * Set the value of disabled
         *
         * @return  self
         */ 
        public function setDisabled($disabled)
        {
                $this->disabled = $disabled;

                return $this;
        }
    }


    $io = new Product(
        1,           
        'reference',
        'image',
        'barcode',
        'label',
        'purchase_price',
        'final_price',
        'price_offer',
        'description',
        'min_quantity',
        'stock_quantity', 
        'category', 
        'disabled'        
    );
    