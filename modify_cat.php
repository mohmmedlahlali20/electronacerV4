<?php
require_once 'categoryDAO.php';

$category = []; // Define an empty array for $category initially
if(isset($_POST['category_id'])) {
setcookie('category_id', $_POST['category_id']);
// print_r($_COOKIE);

}
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // if(isset($_POST['category_id'])) {;//?? null
    $categoryDAO = new CategoryDAO();
    $category = $categoryDAO->getCategoryById($_COOKIE['category_id']);
    // print_r($_COOKIE);
    // if ($category) {
    // }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['update_category'])) {
            if (isset($_POST['name_cat'], $_FILES['file'])) {
                $cat_name = $_POST['name_cat'];
                $photo = basename($_FILES['file']['name']);
                $targetPath = 'images/' . $photo;
                $tempPath = $_FILES['file']['tmp_name'];
                echo$photo ;
                // $categoryDAO->updateCategory($categorynw, $category_id);
                

                move_uploaded_file($tempPath, $targetPath);
                    $categorynw = new Category($_COOKIE['category_id'], $cat_name, $photo);
                    // $categoryDAO = new CategoryDAO();
                    $categoryDAO->updat_category($categorynw, $_COOKIE['category_id']);
                    header("Location: index.php");
                    exit();
                }
            }}
        // }
    // } else {
    //     echo "Category not found!";
      
        
    
// }
require_once 'HEAD.php';
?>


    <h1 class="text-center">Modify Category</h1>

    <div class="container justify-content-center p-5">
        <form class="form-section" method="post" enctype="multipart/form-data">
            <div class="form-group mb-3 w-50 mx-5">
                <label for="name_category">New name</label>
                <input type="text" id="name_category" class="form-control" name="name_cat" value="<?php echo $category['category_name']; ?>" >
            </div>
            
            <div class="form-group mb-3 w-50 mx-5">
            <label for="img_category">Current photo</label>
             <img src="images/<?php echo $category['imag_category']; ?>" alt="Category Image" width="100">
                <input type="file" id="img_category" class="form-control" name="file" >

            
            <button type="submit" name="update_category" class="btn bg-primary text-light mx-5">Modify Your Category</button>
        </form>
    </div>
</body>
</html>