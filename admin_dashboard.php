<?php
include 'connex_db.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="icon" href="img/electric.png">

</head>

<body>
    <?php
    include("nav.php")
    ?>

    <div class="container mt-5">

        <h2 class="mb-4">Menu</h2>

        <!-- Navigation Menu -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
            <div class="container-fluid">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="?page=users_managment">User Section</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?page=category_managment">Category Section</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?page=product_manag">Product Section</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?page=order_management">Order Section</a>
                    </li>
                </ul>
            </div>

        </nav>

        <!-- Your CRUD content goes here -->

    </div>
    <?php
    // Check if a page parameter is set in the URL
    if (isset($_GET['page'])) {
        $page = $_GET['page'];

        // Validate and include the selected page
        if (in_array($page, ['users_managment', 'category_managment', 'product_manag', 'order_management']) && file_exists($page . '.php')) {
            include($page . '.php');
        } else {
            echo '<p class="alert alert-danger">Invalid page selected.</p>';
        }
    } else {
        // Default page to include when no specific page is selected
        include('users_managment.php');
    }

   
    include("footer.php");
    
    ?>

    

</body>

</html>