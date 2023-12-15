<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}

// Add your database connection file
include('db_cnx.php');

// Retrieve cart items from the session
$cartItems = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

// Fetch user information from the database
$userId = $_SESSION['user']['user_id'];
$userSql = "SELECT full_name, address FROM Users WHERE user_id = ?";
$userStmt = $conn->prepare($userSql);
$userStmt->bind_param("i", $userId);
$userStmt->execute();
$userResult = $userStmt->get_result();

// Check for SQL errors
if (!$userResult) {
    echo "Error fetching user information: " . $conn->error;
    exit();
}

// Fetch user data
if ($userResult->num_rows > 0) {
    $userData = $userResult->fetch_assoc();
    $fullName = $userData['full_name'];
    $address = $userData['address'];
} else {
    // Handle the case where user information is not found
    echo "User information not found. Please update your profile.";
    exit();
}

// Close the prepared statement
$userStmt->close();

// Calculate total price
$totalPrice = calculateTotalPrice($cartItems);

// Insert order into the database
$orderSql = "INSERT INTO Orders (user_id, total_price) VALUES (?, ?)";
$orderStmt = $conn->prepare($orderSql);
$orderStmt->bind_param("id", $userId, $totalPrice);
$orderStmt->execute();

// Check for SQL errors
if (!$orderStmt) {
    echo "Error placing order: " . $conn->error;
    exit();
}

// Get the last inserted order ID
$orderId = $orderStmt->insert_id;

// Insert order details into the database
foreach ($cartItems as $item) {
    $productId = $item['product_id'];
    $quantity = $item['quantity'];
    $unitPrice = $item['price'];
    $totalItemPrice = $quantity * $unitPrice;

    $orderDetailsSql = "INSERT INTO OrderDetails (order_id, product_id, quantity, unit_price, total_price) VALUES (?, ?, ?, ?, ?)";
    $orderDetailsStmt = $conn->prepare($orderDetailsSql);
    $orderDetailsStmt->bind_param("iiidd", $orderId, $productId, $quantity, $unitPrice, $totalItemPrice);
    $orderDetailsStmt->execute();

    // Check for SQL errors
    if (!$orderDetailsStmt) {
        echo "Error inserting order details: " . $conn->error;
        exit();
    }
}

// Clear the cart in the session
unset($_SESSION['cart']);

// Redirect to a success page
header("Location: checkout-success.php");
exit();

// Function to calculate total price
function calculateTotalPrice($cartItems)
{
    $totalPrice = 0.0;

    foreach ($cartItems as $item) {
        $totalPrice += $item['quantity'] * $item['price'];
    }

    return $totalPrice;
}