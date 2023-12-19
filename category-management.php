<?php
 require_once 'categoryDAO.php';


?>
<div class="container mt-5">
    <form class="form-section" method="post" enctype="multipart/form-data">
        <div id="categories-container" class="mb-3 w-50">
            <div class="category-entry">
                <label for="name_category" class="form-label">Category Name</label>
                <input type="text" class="form-control" name="name_cat[]">
                <label for="img_category" class="form-label">Category Photo</label>
                <input type="file" class="form-control" name="file[]">
            </div>
        </div>
        <div class="d-flex justify-content-between mx-auto">
            <div class="w-25">
                <button type="button" onclick="addCategoryField()" class="btn btn-secondary text-light w-100">Add Another</button>
            </div>
            <div class="w-25">
                <button type="submit" class="btn btn-primary text-light w-100 p-2">Add</button>
            </div>
        </div>
    </form>
</div>

<?php




if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['name_cat']) && isset($_FILES['file'])) {
        $categoriesCount = count($_POST['name_cat']);

        for ($i = 0; $i < $categoriesCount; $i++) {
            $Category = new Category('', $_POST['name_cat'][$i], $_FILES['file']['name'][$i], '0');
            

            // Sanitize and validate user input
            $categoryName = filter_var($_POST['name_cat'][$i]);
            $Category->setCategory_name($categoryName);

            // File upload handling
            $photo = basename($_FILES['file']['name'][$i]);
            $targetPath = './img/' . $photo;
            $tempPath = $_FILES['file']['tmp_name'][$i];

            if (move_uploaded_file($tempPath, $targetPath)) {

                $class = new CategoryDAO();

                $categoryName = $_POST['name_cat'][$i];

                $Category->setCategory_name($categoryName);
                $Category->setImag_category($photo);
          
                try {
                  
                    $result = $class->insertCategory($Category);
            
                    if ($result) {
                        // Process $result as needed
                        echo "Category inserted successfully.";
                    } else {
                        // Handle database insertion failure
                        echo "Failed to insert category into the database.";
                    }
                } catch (Exception $e) {
                    // Handle other exceptions
                    error_log('Database insertion error: ' . $e->getMessage());
                }
            } else {
                // Handle file upload failure
                error_log('File upload failed for ' . $photo);
            }
            
        }
    }
}
?>

    <h2 class="container text-center bg-dark p-1 text-light">Archived Categories</h2>
    <div id="archived-categories" class="w-100">
        <table class="table table-bordered">
            <thead class="bg-black text-light">
                <tr>
                    <th class="p-3 border-black" scope="col">ID</th>
                    <th class="p-3 border-black" scope="col">Category Name</th>
                    <th class="p-3 border-black" scope="col">Category Image</th>
                    <th class="p-3 border-black" scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $archivedCategories = new CategoryDAO();
                $archivedResults = $archivedCategories->selectData('Categories', '*', 'is_desaybelsd = TRUE');

                if ($archivedResults && count($archivedResults) > 0) {
                    foreach ($archivedResults as $row) {
                        $categoryid = $row['category_id'];
                        $categoryName = $row['category_name'];
                        $categoryImg = $row['imag_category'];

                        echo '<tr>';
                        echo '<td>' . $categoryid . '</td>';
                        echo '<td>' . $categoryName . '</td>';
                        echo '<td><img src="img/' . $categoryImg . '" class="w-25 h-25" alt="Category Image"></td>';
                        echo '<td>
                                <form method="POST" class="category-action-form mx-3">
                                    <input type="hidden" name="category_id" value="' . $categoryid . '">
                                    <a href="restore_cat.php?id=' . $categoryid . '" class="btn btn-warning btn-sm w-4 text-light">Restore</a>
                                </form>
                            </td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="4">No archived categories found</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>






<div class="container mt-5">

    <div id="categories" class="w-100 mb-5">
        <table style=" width: 100%;
        margin-bottom: 1rem;
        color: #212529;
        border-collapse: collapse;" class="table table-bordered">
            <thead class="bg-black text-light">
                <tr style=" padding: 0.75rem;
        text-align: left;
        border: 1px solid #dee2e6;">
                    <th class="p-3 border-black" scope="col">Category ID</th>
                    <th class="p-3 border-black" scope="col">Category Name</th>
                    <th class="p-3 border-black" scope="col">Category Image</th>
                    <th class="p-3 border-black" scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php


$cat_obj = new CategoryDAO();
$categoryRows = $cat_obj->selectData('Categories', '*', 'is_desaybelsd = FALSE'); 

if ($categoryRows !== false) { 
    if (count($categoryRows) > 0) { 
        foreach ($categoryRows as $row) {
            $categoryid = $row['category_id'];
            $categoryName = $row['category_name'];
            $categoryImg = $row['imag_category'];

            echo '<tr  style=" padding: 0.75rem; text-align: left;border: 1px solid #dee2e6;" class="justify-content-center">';
            echo '<td style=" padding: 0.75rem;text-align: left;border: 1px solid #dee2e6;" class="border-black p-3">' . $categoryid . '</td>';
            echo '<td style=" padding: 0.75rem;text-align: left;border: 1px solid #dee2e6;" class="border-black p-3">' . $categoryName . '</td>';
            echo '<td  tyle=" padding: 0.75rem;text-align: left;border: 1px solid #dee2e6;"  class="border-black p-3"><img src="img/' . $categoryImg . '" class="w-25 h-25" alt="Product Image"></td>';
            echo '<td style=" padding: 0.75rem;text-align: left;border: 1px solid #dee2e6;" class="border-black p-2 d-flex">
                        <form method="POST" class="Categories-action-form mx-3">
                            <input type="hidden" name="category_id" value="' . $categoryid . '">
                            <a href="disable_cat.php?id=' . $categoryid . '" type="submit" class="btn btn-danger btn-sm w-4 text-light">Disable</a>
                        </form>
                        <form method="POST" class="Categories-action-form mx-3">
                            <input type="hidden" name="category_id" value="' . $categoryid . '">
                            <a href="modif_cat.php?id=' . $categoryid . '" type="submit" class="btn btn-primary btn-sm w-4 text-light">Modifier</a>
                        </form>
                    </td>';
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='5'>No categories found</td></tr>";
    }
} else {
   
    echo "<tr><td colspan='5'>Error retrieving categories</td></tr>";
}
?>

            </tbody>
        </table>
    </div>
</div>

<script>
function addCategoryField() {
    const categoriesContainer = document.getElementById('categories-container');
    const newCategoryEntry = document.createElement('div');
    newCategoryEntry.classList.add('category-entry');
    newCategoryEntry.innerHTML = `
            <label for="name_category" class="form-label">Category Name</label>
            <input type="text" class="form-control" name="name_cat[]">
            <label for="img_category" class="form-label">Category Photo</label>
            <input type="file" class="form-control" name="file[]">
        `;
    categoriesContainer.appendChild(newCategoryEntry);
    
}
function addCategoryField() {
        var container = document.getElementById('categories-container');
        var entry = document.createElement('div');
        entry.className = 'category-entry';
        entry.innerHTML = '<label for="name_category" class="form-label">Category Name</label>' +
                          '<input type="text" class="form-control" name="name_cat[]">' +
                          '<label for="img_category" class="form-label">Category Photo</label>' +
                          '<input type="file" class="form-control" name="file[]">';
        container.appendChild(entry);
    }
</script>