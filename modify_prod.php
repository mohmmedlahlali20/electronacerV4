<?php
require_once 'productsDAO.php'; 
require_once 'categoryDAO.php'; 

if(isset($_POST['product_id'])) {
setcookie('product_id', $_POST['product_id']);
}
    $productsDAO = new  ProductDAO();
    $products = $productsDAO->getProductById($_COOKIE['product_id']);
    $category =new categoryDAO();
     $categories= $category->get_categorys();
     if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset( $_FILES['file'], $_POST['barcod'],$_POST['label'], $_POST['purch_price'],$_POST['final_price'], $_POST['offre'], $_POST['desc_pro'],$_POST['quntt_min'], $_POST['quntt_stk'])) {
        $label = $_POST['label'];
        $reference = $_POST['reference'];
        $purch_price= $_POST['purch_price'];
        $final_price= $_POST['final_price'];
        $offre= $_POST['offre'];
        $barcod= $_POST['barcod'];
        $pro_desc= $_POST['desc_pro'];
        $quntt_min= $_POST['quntt_min'];
        $quntt_stk=$_POST['quntt_stk'];
        if (isset($_POST['selectedCategory'])) {
            $selectedCategory = $_POST['selectedCategory'];

        }
        $photo = basename($_FILES['file']['name']);
        $targetPath = './images/' . $photo;
        $tempPath = $_FILES['file']['tmp_name'];


        if (move_uploaded_file($tempPath, $targetPath)) {
            $product_modif= new Product($_COOKIE['product_id'], $reference, $photo,$barcod,$label,$purch_price,$final_price,$offre,$pro_desc,$quntt_min,$quntt_stk,$selectedCategory);
            $productsDAO->updat_product( $product_modif , $_COOKIE['product_id']) ;
            header("Location: product_manag.php");
            exit();
        }
    }}

require_once 'HEAD.php'; 
?>

<h1 class="text-center">Modify Product</h1>

<div class="container justify-content-center p-5">
    <form class="form-section" method="post" enctype="multipart/form-data">
        
       <div class="form-group mb-3 w-50 mx-5" >
       <label for="img_category">new photo</label>
       <img src="<?= $products['image']?>" alt="product image">
       <input type="file" id="img_category" class="form-control" name="file" >
       </div>
       <div class="form-group mb-3 w-50 mx-5" >
       <label for="name_category">barcode</label>
       <input type="numner" id="name_category" class="form-control" name="barcod" value="<?= $products['barcode']?>" >

       </div>
       <div class="form-group mb-3 w-50 mx-5" >
       <label for="name_category">label</label>
       <input type="text" id="name_category" class="form-control" name="label" value="<?= $products['label']?>">

       </div>
       <div class="form-group mb-3 w-50 mx-5" >
       <label for="name_category">reference</label>
       <input type="text" id="name_category" class="form-control" name="reference" value="<?= $products['reference']?>">

       </div>
       <div class="form-group mb-3 w-50 mx-5" >
       <label for="name_category">purchase price</label>
       <input type="numner" id="name_category" class="form-control" name="purch_price" value="<?= $products['purchase_price']?>">

       </div>
       <div class="form-group mb-3 w-50 mx-5" >
       <label for="name_category">final price</label>
       <input type="numner" id="name_category" class="form-control" name="final_price" value="<?= $products['final_price']?>">

       </div>
       <div class="form-group mb-3 w-50 mx-5" >
       <label for="name_category">price offer</label>
       <input type="numner" id="name_category" class="form-control" name="offre" value="<?= $products['price_offer']?>">

       </div>
       <div class="mb-3 w-50 mx-5">
  <label for="description" class="form-label ">new description</label>
  <textarea class="form-control" id="description" name="desc_pro" rows="3"><?= $products['description']?></textarea>
</div>
       <div class="form-group mb-3 w-50 mx-5" >
       <label for="name_category">quantity mini</label>
       <input type="numner" id="name_category" class="form-control" name="quntt_min" value="<?= $products['min_quantity']?>">

       </div>
       <div class="form-group mb-3 w-50 mx-5" >
       <label for="name_category">quantity de stok</label>
       <input type="numner" id="name_category" class="form-control" name="quntt_stk" value="<?= $products['stock_quantity']?>">

       </div>
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
       <button  type="submit" name="submit" class="btn bg-primary text-light mx-4 nani">modifier</button>
    </form>
    </div>
</body>
</html>
