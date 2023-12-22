<?php
require_once 'categoryDAO.php'; 
$category =new categoryDAO();


$categories= $category->get_categorys();



       
        
       foreach( $categories as $cat1){
            $categoryId = $cat1->getCategoryId();
            $categoryName =  $cat1->getCategoryName();
            
            echo '<option value="' . $categoryId . '" style="color: red; font-size: 18px;">' . $categoryName . '</option>';
        }
        ?>