<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Product Details</title>
</head>

<body>

    <div class="container mt-5">
        <?php
        session_start(); // Start the session
        include 'db_cnx.php'; // Include your database connection file

        // Get product ID from the URL
        $product_id = $_GET['id'];

        // Fetch product details
        $sql = "SELECT * FROM Products WHERE product_id = $product_id";
        $result = mysqli_query($conn, $sql);

        // Check if the product exists
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
        ?>
            <div class="card">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img src="<?php echo $row['image']; ?>" alt="<?php echo $row['label']; ?>" class="card-img">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['label']; ?></h5>
                            <p class="card-text"><strong>Reference:</strong> <?php echo $row['reference']; ?></p>
                            <p class="card-text"><strong>Description:</strong> <?php echo $row['description']; ?></p>
                            <p class="card-text"><strong>Price:</strong> $<?php echo $row['final_price']; ?></p>
                            <p class="card-text"><strong>Stock Quantity:</strong> <?php echo $row['stock_quantity']; ?></p>
                            <!-- Add to Cart button -->
                            <button class="btn btn-primary" onclick="addToCart(<?php echo $row['product_id']; ?>)">Add to
                                Cart</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        } else {
            echo "<p class='alert alert-danger'>Product not found</p>";
        }

        // Close the database connection
        mysqli_close($conn);
        ?>
    </div>



    <script>
        // JavaScript function to handle adding products to the cart
        function addToCart(productId) {
            // Use AJAX to send a request to your server to add the product to the cart
            $.ajax({
                type: "POST",
                url: "add_to_cart.php", // Replace with your server-side endpoint
                data: {
                    product_id: productId
                },
                success: function(response) {
                    alert(response); // Display a success message or handle the response as needed
                },
                error: function(error) {
                    alert("Error adding to cart. Please try again."); // Handle errors
                }
            });
        }
    </script>

    <?php
    include("footer.php")
    ?>