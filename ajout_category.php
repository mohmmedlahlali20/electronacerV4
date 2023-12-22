<?php
require_once 'categoryDAO.php';
$categoryDAO = new categoryDAO();
require_once 'HEAD.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['name_cat']) && isset($_FILES['file'])) {
        $categoriesCount = count($_POST['name_cat']);

        for ($i = 0; $i < $categoriesCount; $i++) {
            $cat_name = $_POST['name_cat'][$i];
            $photo = basename($_FILES['file']['name'][$i]);
            $targetPath = './images/' . $photo;
            $tempPath = $_FILES['file']['tmp_name'][$i];

            if (move_uploaded_file($tempPath, $targetPath)) {
                $categorynw = new Category('', $cat_name, $photo);
                $categoryDAO->insert_category($categorynw);
            } else {
                echo "Error uploading file.";
            }
        }
        header("Location: index.php");
        exit();
    }
}

?>

<h3 class="text-center ">ajoyter category</h3>
<form class="form-section mt-5" method="post" enctype="multipart/form-data">
    <div id="categories-container" class="mb-3 w-50 mx-5">
        <div class="category-entry">
            <label for="name_category">Category Name</label>
            <input type="text" class="form-control" name="name_cat[]">
            <label for="img_category">Category Photo</label>
            <input type="file" class="form-control" name="file[]">
        </div>
    </div>
    <div class="d-flex mx-3">
    <div class="d-grid my-3 w-25 ">

    <button type="button" onclick="addCategoryField()" class="btn btn-secondary text-light  w-25">Another</button>
    </div>

    <div class="d-grid my-3 w-25 ">
        <button type="submit" class="btn btn-primary text-light  w-25 p-1">Add </button>
    </div>
    </div>
</form>

<script>
    function addCategoryField() {
        const categoriesContainer = document.getElementById('categories-container');
        const newCategoryEntry = document.createElement('div');
        newCategoryEntry.classList.add('category-entry');
        newCategoryEntry.innerHTML = `
            <label for="name_category">Category Name</label>
            <input type="text" class="form-control" name="name_cat[]">
            <label for="img_category">Category Photo</label>
            <input type="file" class="form-control" name="file[]">
        `;
        categoriesContainer.appendChild(newCategoryEntry);
    }
</script>
