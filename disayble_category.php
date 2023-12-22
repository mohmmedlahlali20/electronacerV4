<?php

require_once 'categoryDAO.php';



if (isset($_POST['delete_category'])) {
    if (isset($_POST['category_id'])) {
        $category_id = $_POST['category_id'];

        
        $categoryDAO = new categoryDAO();
        
        
        $categoryDAO->disaplay_category($category_id);

        header("Location: inex.php");
        exit();
    }
}
