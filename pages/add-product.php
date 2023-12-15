    <?php
    require 'db_cnx.php';

    // Check for form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
        // Sanitize and validate form data
        $reference = $_POST['reference'];
        $label = $_POST['product_name'];
        $description = $_POST['description'];
        $purchase_price = $_POST['purchase_price'];
        $barcode = $_POST['barcode'];
        $price_offer = $_POST['price_offer'];
        $final_price = $_POST['final_price'];
        $min_quantity = $_POST['min_quantity'];
        $stock_quantity = $_POST['stock_quantity'];

        // Upload the image to the server
        $img_name = mysqli_real_escape_string($conn, $_FILES['image']['name']);
        $img_size = $_FILES['image']['size'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $error = $_FILES['image']['error'];

        // Check if the uploaded image is valid
        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
        $img_ex_lc = strtolower($img_ex);
        $allowed_exs = array("jpg", "jpeg", "png");

        if (in_array($img_ex_lc, $allowed_exs)) {
            $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
            $img_upload_path = './img/' . $new_img_name;
            move_uploaded_file($tmp_name, $img_upload_path);

            // Insert a new product into the 'Products' table without prepared statements
            $query = "INSERT INTO Products (reference,label, description, purchase_price, barcode ,price_offer, final_price, min_quantity, stock_quantity, image) 
            VALUES ('$reference' ,'$label', '$description', $purchase_price,'$barcode', '$price_offer', $final_price, $min_quantity, $stock_quantity, '$new_img_name')";

            if (mysqli_query($conn, $query)) {
                // Successfully inserted
                echo "Product added successfully!";
            } else {
                // Error inserting
                echo "Error: " . mysqli_error($conn);
            }
        }
    }
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
        <title>Add Product</title>
        <style>
            .card {
                margin-bottom: 20px;
            }
        </style>
    </head>

    <body>
        <form method="post" action="" enctype="multipart/form-data" class="container mt-5">
            <!-- Product Reference -->
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Reference</span>
                <input type="text" class="form-control" placeholder="Reference" name="reference" aria-label="Reference" aria-describedby="basic-addon1" required>
            </div>
            <!-- Product Label -->
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Label</span>
                <input type="text" class="form-control" placeholder="Product Name" name="product_name" aria-label="Product Name" aria-describedby="basic-addon1" required>
            </div>
            <!-- Product description -->
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Description</span>
                <input type="text" class="form-control" placeholder="Description" name="description" aria-label="Description" aria-describedby="basic-addon1" required>
            </div>
            <!-- Product purchase_price -->
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Purchase Price</span>
                <input type="text" class="form-control" placeholder="Purchase Price" name="purchase_price" aria-label="Purchase Price" aria-describedby="basic-addon1" required>
            </div>
            <!-- Product purchase_price -->
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Barcode</span>
                <input type="text" class="form-control" placeholder="Barcode" name="barcode" aria-label="Barcode" aria-describedby="basic-addon1" required>
            </div>
            <!-- Product price_offer -->
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Price Offer</span>
                <input type="text" class="form-control" placeholder="Price Offer" name="price_offer" aria-label="Price Offer" aria-describedby="basic-addon1" required>
            </div>
            <!-- Product final_price -->
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Final Price</span>
                <input type="text" class="form-control" placeholder="Final Price" name="final_price" aria-label="Final Price" aria-describedby="basic-addon1" required>
            </div>
            <!-- Product min_quantity -->
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Min Quantity</span>
                <input type="text" class="form-control" placeholder="Min Quantity" name="min_quantity" aria-label="Min Quantity" aria-describedby="basic-addon1" required>
            </div>
            <!-- Product stock_quantity -->
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Stock Quantity</span>
                <input type="text" class="form-control" placeholder="Stock Quantity" name="stock_quantity" aria-label="Stock Quantity" aria-describedby="basic-addon1" required>
            </div>
            <!-- Image du produit -->
            <div class="mb-3 mt-3">
                <label for="product_image" class="form-label">Image du produit</label>
                <div class="input-group">
                    <input type="file" class="form-control" name="image" id="product_image" required>
                </div>
                <div class="form-text mt-2">Téléchargez une image du produit.</div>
            </div>

            <!-- Category du produit -->
            <div class="input-group mb-3">
                <label class="input-group-text" for="category">Category</label>
                <select class="form-select" id="category" name="category" required>
                    <option value="" selected disabled>Select a category</option>
                    <?php
                    // Fetch categories from the 'Categories' table
                    $categorySql = "SELECT * FROM Categories";
                    $categoryResult = mysqli_query($conn, $categorySql);

                    // Display categories in the dropdown menu
                    while ($categoryRow = mysqli_fetch_assoc($categoryResult)) {
                        echo "<option value='" . $categoryRow['category_id'] . "'>" . $categoryRow['category_name'] . "</option>";
                    }

                    mysqli_close($conn);
                    ?>
                </select>
            </div>

            <!-- Bouton pour soumettre le formulaire -->
            <div class="d-grid mt-3">
                <button type="submit" class="btn btn-primary btn-sm w-100" name="submit">Ajouter un produit</button>
                <a href="admin-dashboard.php?page=product-management">Display Products</a>
            </div>
        </form>
        <?php include("footer.php"); ?>