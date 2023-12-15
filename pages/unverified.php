<?php
session_start(); // Start the session
include 'db_cnx.php'; // Include your database connection file

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];

    // Check if the user is verified
    $verificationStatusSql = "SELECT verified FROM Users WHERE user_id = $userId";
    $verificationStatusResult = $conn->query($verificationStatusSql);

    if ($verificationStatusResult && $verificationStatusResult->num_rows > 0) {
        $user = $verificationStatusResult->fetch_assoc();
        $isVerified = $user['verified'];

        if (!$isVerified) {
            // User is not verified, display unverified content
?>

            <!DOCTYPE html>
            <html lang="en">

            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Unverified User</title>

                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

                <style>
                    body {
                        background-color: #f8f9fa;
                    }

                    .container {
                        margin-top: 50px;
                    }

                    .card {
                        margin-bottom: 20px;
                    }
                </style>
            </head>

            <body>
                <!-- Navbar -->
                <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="#">Your Brand</a>
                        
                    </div>
                </nav>

                <div class="container">
                    <h2 class="mb-4">Unverified User</h2>

                    <!-- Unverified user content goes here -->
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Verification Required</h4>
                            <p class="card-text">Your account is not verified. Please complete the verification process.</p>
                            <!-- Add instructions or a link for the verification process -->
                        </div>
                    </div>
                </div>

                <?php
                include("footer.php")
                ?>
    <?php
        } else {
            header("Location: dashboard.php");
            exit();
        }
    } else {
        // Handle the case where the user record is not found
        echo "Error fetching user information.";
    }
} else {
    // Redirect to the login page if the user is not logged in
    header("Location: login.php");
    exit();
}

// Close the database connection
$conn->close();
    ?>