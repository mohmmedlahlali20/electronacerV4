<?php
require_once 'productsDAO.php'; 
require_once 'categoryDAO.php'; 
require_once 'HEAD.php'; 
$productsDAO = new  ProductDAO();
$category =new categoryDAO();


$categories= $category->get_categorys();

?>



<form method="post" action="" enctype="multipart/form-data" class="container mt-5">
            <div id="products-container"> 
                <div class="product">
            <!-- Product Reference -->
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

            <!-- Category du produit -->
            <div class="form-group mb-3 w-50 mx-5" >
       <select name="selectedCategory" id="categorySelect">
        <?php
       
        
       foreach( $categories as $cat1){
            $categoryId = $cat1->getCategoryId();
            $categoryName =  $cat1->getCategoryName();
            
            echo '<option value="' . $categoryId . '" style="color: red; font-size: 18px;">' . $categoryName . '</option>';
        }
        ?>
        </select>
       </div>
            </div>
            </div>
            <div class="d-grid mt-3">
            <button type="button" onclick="addProduct()">Add Another Product</button> 
                </div>
            <div class="d-grid mt-3">
                <button type="submit" class="btn btn-primary btn-sm w-100" name="submit">Ajouter un produit</button>
                <a href="admin-dashboard.php?page=product-management">Display Products</a>
           
        </form>
        <script>
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
         
            
       
    }
    
    </script>