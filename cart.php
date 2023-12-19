<?php
session_start();

// Clear the cart
if (isset($_GET['action']) && $_GET['action'] == 'clear') {
    unset($_SESSION['cart']);
    header("Location: cart.php");
    exit();
}

// Add an item to the cart
if (isset($_GET['action']) && $_GET['action'] == 'add') {
    // Check if the product ID is valid
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        // Get product details
        $productId = $_GET['id'];
        $productName = isset($_POST['hidden_name']) ? $_POST['hidden_name'] : '';
        $productPrice = isset($_POST['hidden_price']) ? $_POST['hidden_price'] : '';
        $quantity = 1; // You can adjust this based on user input

        // Validate product details
        if (empty($productName) || empty($productPrice)) {
            // Handle validation error more gracefully (e.g., redirect with an error message)
            header("Location: products.php?error=invalid_product_details");
            exit();
        }

        // Initialize the cart session variable if not exists
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }

        // Create the cart item
        $cartItem = array(
            'id' => $productId,
            'name' => $productName,
            'price' => $productPrice,
            'quantity' => $quantity
        );

        // Check if the product is already in the cart
        $cartIndex = array_search($productId, array_column($_SESSION['cart'], 'id'));

        // If the product is in the cart, update the quantity
        if ($cartIndex !== false) {
            $_SESSION['cart'][$cartIndex]['quantity'] += $quantity;
        } else {
            // If not, add the product to the cart
            $_SESSION['cart'][] = $cartItem;
        }

        // Redirect to the products page after adding an item
        header("Location: products.php");
        exit();
    }
}

// Other cart-related logic, such as updating quantities, removing items, etc.

// Redirect back to the products page (default redirect)
header("Location: products.php");
exit();