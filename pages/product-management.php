<?php
// Add this line to enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'db_cnx.php';

/// Handle form submission for enabling/disabling
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["toggle_product"])) {
    $productId = $_POST["toggle_product"];

    // Toggle the disable status for the specified product
    $conn->query("UPDATE Products SET disabled = NOT disabled WHERE product_id = $productId");
}


// Fetch existing products from the 'Products' table
$sql = "SELECT * FROM Products";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>Product Management</title>
</head>

<body>

    <div class="container mt-5">
        <form method='POST'>
            <a href='add-product.php' class='btn btn-success mb-3'>Add Product</a>
            <table class='table table-bordered table-striped'>
                <thead class='thead-dark'>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Reference</th>
                        <th>Label</th>
                        <th>Description</th>
                        <th>Final Price</th>
                        <th>Barcode</th>
                        <th>Purchase Price</th>
                        <th>Min Quantity</th>
                        <th>Stock Quantity</th>
                        <th>Disable</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Loop through each product and display information in a table row
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['product_id'] . "</td>";
                        // Display the product image
                        echo "<td><img src='./img/" . $row['image'] . "' width='100' height='100'></td>";

                        echo "<td>" . $row['reference'] . "</td>";
                        echo "<td>" . $row['label'] . "</td>";
                        echo "<td>" . $row['description'] . "</td>";
                        echo "<td>" . $row['final_price'] . "</td>";
                        echo "<td>" . $row['barcode'] . "</td>";
                        echo "<td>" . $row['purchase_price'] . "</td>";
                        echo "<td>" . $row['min_quantity'] . "</td>";
                        echo "<td>" . $row['stock_quantity'] . "</td>";
                        echo "<td>" . ($row['disabled'] ? 'Yes' : 'No') . "</td>";

                        echo "<td>
            <button type='submit' name='toggle_product' value='" . $row['product_id'] . "' class='btn btn-warning btn-sm btn-disable mx-2'>" . ($row['disabled'] ? 'Enable' : 'Disable') . "</button>
            <a class='btn btn-primary' href='edit-product.php?id=" . $row['product_id'] . "'>Edit</a>
            </td>";

                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </form>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php
// Close the database connection
mysqli_close($conn);
?>