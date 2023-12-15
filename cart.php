<?php
session_start();
if (isset($_GET['action']) && $_GET['action'] == 'clear') {
    // Clear the cart
    unset($_SESSION['cart']);
    header("Location: cart.php"); // Redirect back to the cart page
    exit();
}
// Check if the action is to add an item to the cart
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
            throw new Exception('Invalid product details.');
        }

        // Create the cart item
        $cartItem = array(
            'id' => $productId,
            'name' => $productName,
            'price' => $productPrice,
            'quantity' => $quantity
        );

        // Check if the cart session variable exists
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }

        // Check if the product is already in the cart
        $cartIndex = -1;
        foreach ($_SESSION['cart'] as $key => $item) {
            if ($item['id'] == $productId) {
                $cartIndex = $key;
                break;
            }
        }

        // If the product is in the cart, update the quantity
        if ($cartIndex !== -1) {
            $_SESSION['cart'][$cartIndex]['quantity'] += $quantity;
        } else {
            // If not, add the product to the cart
            $_SESSION['cart'][] = $cartItem;
        }

        // Debug: Output session and cart information
        echo '<pre>';
        var_dump($_SESSION);
        echo '</pre>';
    }
}

// Other cart-related logic, such as updating quantities, removing items, etc.

// Redirect back to the product page or display a message as needed
header("Location: products.php");
exit();
