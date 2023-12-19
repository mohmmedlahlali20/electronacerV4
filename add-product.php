<?php
require 'connexion.php';
include 'categoryDAO.php';
include 'ProductDAO.php';


if  ($_SERVER['REQUEST_METHOD'] == 'POST') {
    foreach ($_POST['product_name'] as $key => $productName) {
        $label = $_POST['product_name'][$key];
        $description = $_POST['description'][$key];
        $purchase_price = $_POST['purchase_price'][$key];
        $barcode = $_POST['barcode'][$key];
        $price_offer = $_POST['price_offer'][$key];
        $final_price = $_POST['final_price'][$key];
        $min_quantity = $_POST['min_quantity'][$key];
        $stock_quantity = $_POST['stock_quantity'][$key];
        $category_id = $_POST['category'][$key];

            $class = new CategoryDAO();

        $CategoryDAO = $class->selectData('category_id', 'Categories', $category_id);
        
        // Assuming 'selectData' is a method in your CategoryDAO class
        
        $checkCategoryResult = mysqli_query($conn, $checkCategoryQuery);

        $img_name = $_FILES['image']['name'][$key];
        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
        $img_ex_lc = strtolower($img_ex);
        $allowed_exs = array("jpg", "jpeg", "png");

        if (in_array($img_ex_lc, $allowed_exs)) {
            $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
            $img_upload_path = './img/' . $new_img_name;
            move_uploaded_file($_FILES['image']['tmp_name'][$key], $img_upload_path);

            if (mysqli_num_rows($checkCategoryResult) > 0) {

                $class_product = new fetchingdata();

                $query = $class_product->Insert_Product($Product);

                if (mysqli_query($conn, $query)) {
                    echo "Product added successfully!";
                } else {
                    echo "Error: " . mysqli_error($conn);
                }
            }
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Add Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/font/bootstrap-icons.min.css"
        integrity="sha512-oAvZuuYVzkcTc2dH5z1ZJup5OmSQ000qlfRvuoTTiyTBjwX1faoyearj8KdMq0LgsBTHMrRuMek7s+CxF8yE+w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
    .card {
        margin-bottom: 20px;
    }
    </style>
</head>

<body>
    <form method="post" action="" enctype="multipart/form-data" class="container mt-5">
        <div id="products-container">
            <div class="product">
                <!-- Product Reference -->
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Reference</span>
                    <input type="text" class="form-control" placeholder="Reference" name="reference"
                     aria-label="Reference" aria-describedby="basic-addon1" required>

                </div>
                <!-- Product Label -->
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Label</span>
                    <input type="text" class="form-control" placeholder="Product Name" name="product_name[]"
                        aria-label="Product Name" aria-describedby="basic-addon1" required>
                </div>
                <!-- Product description -->
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Description</span>
                    <input type="text" class="form-control" placeholder="Description" name="description[]"
                        aria-label="Description" aria-describedby="basic-addon1" required>
                </div>
                <!-- Product purchase_price -->
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Purchase Price</span>
                    <input type="text" class="form-control" placeholder="Purchase Price" name="purchase_price[]"
                        aria-label="Purchase Price" aria-describedby="basic-addon1" required>
                </div>
                <!-- Product purchase_price -->
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Barcode</span>
                    <input type="text" class="form-control" placeholder="Barcode" name="barcode[]" aria-label="Barcode"
                        aria-describedby="basic-addon1" required>
                </div>
                <!-- Product price_offer -->
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Price Offer</span>
                    <input type="text" class="form-control" placeholder="Price Offer" name="price_offer[]"
                        aria-label="Price Offer" aria-describedby="basic-addon1" required>
                </div>
                <!-- Product final_price -->
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Final Price</span>
                    <input type="text" class="form-control" placeholder="Final Price" name="final_price[]"
                        aria-label="Final Price" aria-describedby="basic-addon1" required>
                </div>
                <!-- Product min_quantity -->
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Min Quantity</span>
                    <input type="text" class="form-control" placeholder="Min Quantity" name="min_quantity[]"
                        aria-label="Min Quantity" aria-describedby="basic-addon1" required>
                </div>
                <!-- Product stock_quantity -->
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Stock Quantity</span>
                    <input type="text" class="form-control" placeholder="Stock Quantity" name="stock_quantity[]"
                        aria-label="Stock Quantity" aria-describedby="basic-addon1" required>
                </div>
                <!-- Image du produit -->
                <div class="mb-3 mt-3">
                    <label for="product_image" class="form-label">Image du produit</label>
                    <div class="input-group">
                        <input type="file" class="form-control" name="image[]" id="product_image" required>
                    </div>
                    <div class="form-text mt-2">Téléchargez une image du produit.</div>
                </div>

                <!-- Category du produit -->
                <div class="input-group mb-3">
                    <label class="input-group-text" for="category">Category</label>
                    <select class="form-select" id="category" name="category[]" required>
                        <option value="" selected disabled>Select a category</option>
                        <?php
                        // Fetch categories from the 'Categories' table
                        $class = new CategoryDAO();

                        $CategoryDAO = $class->selectData('Categories');
                        

                        // Display categories in the dropdown menu
                        while ($categoryRow = mysqli_fetch_assoc($categoryResult)) {
                            echo "<option value='" . $categoryRow['category_id'] . "'>" . $categoryRow['category_name'] . "</option>";
                        }

                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="d-grid mt-3">
            <button type="button" onclick="addProduct()">Add Another Product</button>
        </div>
        <!-- Bouton pour soumettre le formulaire -->
        <div class="d-grid mt-3">
            <button type="submit" class="btn btn-primary btn-sm w-100" name="submit">Ajouter un produit</button>
            <a href="admin-dashboard.php?page=product-management">Display Products</a>

    </form>
    <script>
    // JavaScript to add more product fields
    function addProduct() {
        const productsContainer = document.getElementById('products-container');
        const newProduct = document.createElement('div');
        newProduct.classList.add('product');
        newProduct.innerHTML = `
        <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Reference</span>
                <input type="text" class="form-control" placeholder="Reference" name="reference[]" aria-label="Reference" aria-describedby="basic-addon1" required>
            </div>
            <!-- Product Label -->
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Label</span>
                <input type="text" class="form-control" placeholder="Product Name" name="product_name[]" aria-label="Product Name" aria-describedby="basic-addon1" required>
            </div>
            <!-- Product description -->
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Description</span>
                <input type="text" class="form-control" placeholder="Description" name="description[]" aria-label="Description" aria-describedby="basic-addon1" required>
            </div>
            <!-- Product purchase_price -->
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Purchase Price</span>
                <input type="text" class="form-control" placeholder="Purchase Price" name="purchase_price[]" aria-label="Purchase Price" aria-describedby="basic-addon1" required>
            </div>
            <!-- Product purchase_price -->
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Barcode</span>
                <input type="text" class="form-control" placeholder="Barcode" name="barcode[]" aria-label="Barcode" aria-describedby="basic-addon1" required>
            </div>
            <!-- Product price_offer -->
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Price Offer</span>
                <input type="text" class="form-control" placeholder="Price Offer" name="price_offer[]" aria-label="Price Offer" aria-describedby="basic-addon1" required>
            </div>
            <!-- Product final_price -->
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Final Price</span>
                <input type="text" class="form-control" placeholder="Final Price" name="final_price[]" aria-label="Final Price" aria-describedby="basic-addon1" required>
            </div>
            <!-- Product min_quantity -->
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Min Quantity</span>
                <input type="text" class="form-control" placeholder="Min Quantity" name="min_quantity[]" aria-label="Min Quantity" aria-describedby="basic-addon1" required>
            </div>
            <!-- Product stock_quantity -->
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Stock Quantity</span>
                <input type="text" class="form-control" placeholder="Stock Quantity" name="stock_quantity[]" aria-label="Stock Quantity" aria-describedby="basic-addon1" required>
            </div>
            <!-- Image du produit -->
            <div class="mb-3 mt-3">
                <label for="product_image" class="form-label">Image du produit</label>
                <div class="input-group">
                    <input type="file" class="form-control" name="image[]" id="product_image" required>
                </div>
                <div class="form-text mt-2">Téléchargez une image du produit.</div>
            </div>
            `;

        const categoryDropdown = document.createElement('div');
        categoryDropdown.classList.add('input-group', 'mb-3');
        categoryDropdown.innerHTML = `
            <label class="input-group-text" for="category">Category</label>
            <select class="form-select" id="category" name="category[]" required>
                <option value="" selected disabled>Select a category</option>
            </select>
        `;
        newProduct.appendChild(categoryDropdown);

        // Fetch categories using AJAX
        fetchCategories()
            .then(categories => {
                const categorySelect = categoryDropdown.querySelector('select');
                categories.forEach(category => {
                    const option = document.createElement('option');
                    option.value = category.category_id;
                    option.textContent = category.category_name;
                    categorySelect.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Error fetching categories:', error);
            });

        productsContainer.appendChild(newProduct);
    }

    function fetchCategories() {
        return fetch('get_categories.php') // Replace with your server endpoint that returns categories
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            });

    }
    </script>

</body>

</html>