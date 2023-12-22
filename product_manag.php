<?php 
require_once 'productsDAO.php'; // Include the ProductDAO
$productDAO = new ProductDAO(); // Create an instance of ProductDAO
$products = $productDAO->getProducts(); // Fetch products
require_once 'HEAD.php'; // Include your head file
?>

<h1 class="text-center">List of Products</h1>

<div class="container ">
    <a class="btn btn-primary  my-3" href="ajout_products.php">Add Product</a>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th class="p-3 border-black" scope="col">Product ID</th>
            <th class="p-3 border-black" scope="col">Reference</th>
            <th class="p-3 border-black" scope="col">Image</th>
            <th class="p-3 border-black" scope="col">barcode</th>
            <th class="p-3 border-black" scope="col">label</th>
            <th class="p-3 border-black" scope="col">purchase_price</th>
            <th class="p-3 border-black" scope="col">final_price</th>
            <th class="p-3 border-black" scope="col">price offer</th>
            <th class="p-3 border-black" scope="col">description</th>
            <th class="p-3 border-black" scope="col">min quantity</th>
            <th class="p-3 border-black" scope="col">stock quantity</th>
            <th class="p-3 border-black" scope="col"> category_id</th>
            <th class="p-3 border-black" scope="col">archif/modifier</th>
            
            <!-- Add more headers for additional details if needed -->
        </tr>
    </thead>
    <tbody>
    <?php
    foreach ($products as $product) { ?>

        <tr> 
            <td><?=$product->gettproduct_id()?></td>
            <td><?=$product->gettreference()?></td>
            <td><?=$product->gettimage()?></td>
            <td><?=$product->gettbarcode()?></td>
            <td><?=$product->gettlabel()?></td>
            <td><?=$product->gettpurchase_price()?></td>
            <td><?=$product->gettfinal_price()?></td>
            <td><?=$product->gettprice_offer()?></td>
            <td><?=$product->gettdescription()?></td>
            <td><?=$product->gettmin_quantity()?></td>
            <td><?=$product->gettstock_quantity()?></td>
            <td><?=$product->gettcategory_id()?></td>
            <td>
            <div class="d-flex mx-1">
                         <form method="post" action="disayble_product.php"> 
                          <input type="hidden" name="product_id" value="<?=$product->gettproduct_id()?>" />
                            <button type="submit" class="btn btn-danger" name="delete_product">Delete</button>
                         </form>
                         

                         
                         <form method="post" action="modify_prod.php"> 
                          <input type="hidden" name="product_id" value="<?=$product->gettproduct_id()?>" />
                            <button type="submit" class="btn btn-primary" name="modify_product">modify</button></td>
                         </form>
                         </div>
            </td>

          
            <!-- Add more table cells for additional details if needed -->
        </tr>
    <?php } ?>
    </tbody>
</table>
</body>
</html>
