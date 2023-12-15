<?php

// Access session variables
$userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';
$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
$userRole = isset($_SESSION["user"]["role"]) ? $_SESSION["user"]["role"] : '';

// Fetch the items in the cart (you need to implement this logic)
$cartItems = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$cartItemCount = count($cartItems);
?>

<!-- Navigation Bar -->
<div class="d-flex ">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-5 w-100">
        <a class="navbar-brand" href="home.php">ElectroLharba</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <!-- Other menu items -->
                <div class="ctr d-flex px-5">
    
                    <li class="nav-item">
                        <a class="nav-link" href="home.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="products.php">Products</a>
                    </li>
                </div>
                <?php
                // Check if the user is an admin
                if ($userRole === 'admin') { ?>
                    <!-- Admin menu items -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Admin
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="admin-dashboard.php">Admin Dashboard</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="logout.php">Logout</a>
                        </div>
                    </li>
                <?php } ?>
    
                <?php
                // Check if the user is a regular user
                if ($userRole === 'user') { ?>
                    <!-- User menu items -->
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            USER
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="user-account.php">User Account</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="logout.php">Logout</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="modal" data-target="#cartModal">
                            <i class="fas fa-shopping-cart"></i> Cart
                            <?php if ($cartItemCount > 0) { ?>
                                <span class="badge badge-light"><?php echo $cartItemCount; ?></span>
                            <?php } ?>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </nav>
</div>


<!-- Cart Modal -->
<div class="modal fade" id="cartModal" tabindex="-1" role="dialog" aria-labelledby="cartModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cartModalLabel">Shopping Cart</h5>
            </div>
            <div class="modal-body">
                <?php if ($cartItemCount > 0) { ?>
                    <ul class="list-group">
                        <?php foreach ($cartItems as $item) { ?>
                            <li class="list-group-item">
                                <?php echo $item['name']; ?> - Quantity: <?php echo $item['quantity']; ?>
                            </li>
                        <?php } ?>
                    </ul>
                <?php } else { ?>
                    <p>Your cart is empty.</p>
                <?php } ?>
            </div>
            <div class="modal-footer">
                <?php if ($cartItemCount > 0) { ?>
                    <!-- Button to Checkout Page -->
                    <a href="checkout.php" class="btn btn-primary">Proceed to Checkout</a>
                    <!-- Button to Clear Cart -->
                    <a href="cart.php?action=clear" class="btn btn-danger">Clear Cart</a>
                <?php } ?>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <!-- Additional actions/buttons can be added here -->
            </div>
        </div>
    </div>
</div>