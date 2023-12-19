<?php 
 
 require_once  'connexion.php';
 class Category{
    private $category_id;
    private $category_name;
    private $imag_category;
    private $is_desaybelsd;


public function __construct($category_id,$category_name,$imag_category,$is_desaybelsd){

    $this->category_id = $category_id;
    $this->category_name = $category_name;
    $this->imag_category = $imag_category;
    $this->is_desaybelsd = $is_desaybelsd;




        }




    /**
     * Get the value of category_id
     */ 
    public function getCategory_id()
    {
        return $this->category_id;
    }

    /**
     * Set the value of category_id
     *
     * @return  self
     */ 
    public function setCategory_id($category_id)
    {
        $this->category_id = $category_id;

        return $this;
    }

    /**
     * Get the value of category_name
     */ 
    public function getCategory_name()
    {
        return $this->category_name;
    }

    /**
     * Set the value of category_name
     *
     * @return  self
     */ 
    public function setCategory_name($category_name)
    {
        $this->category_name = $category_name;

        return $this;
    }

    /**
     * Get the value of imag_category
     */ 
    public function getImag_category()
    {
        return $this->imag_category;
    }

    /**
     * Set the value of imag_category
     *
     * @return  self
     */ 
    public function setImag_category($imag_category)
    {
        $this->imag_category = $imag_category;

        return $this;
    }

    /**
     * Get the value of is_desaybelsd
     */ 
    public function getIs_desaybelsd()
    {
        return $this->is_desaybelsd;
    }

    /**
     * Set the value of is_desaybelsd
     *
     * @return  self
     */ 
    public function setIs_desaybelsd($is_desaybelsd)
    {
        $this->is_desaybelsd = $is_desaybelsd;

        return $this;
    }

    
 }