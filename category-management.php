<?php
include('db_cnx.php');


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>manage categories</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/font/bootstrap-icons.min.css" integrity="sha512-oAvZuuYVzkcTc2dH5z1ZJup5OmSQ000qlfRvuoTTiyTBjwX1faoyearj8KdMq0LgsBTHMrRuMek7s+CxF8yE+w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   
</head>
<body>

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

<?php
include('db_cnx.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['name_cat']) && isset($_FILES['file'])) {
        $categoriesCount = count($_POST['name_cat']);

        for ($i = 0; $i < $categoriesCount; $i++) {
            $cat_name = $_POST['name_cat'][$i];
            $photo = basename($_FILES['file']['name'][$i]);
            $targetPath = './img/' . $photo;
            $tempPath = $_FILES['file']['tmp_name'][$i];

            if (move_uploaded_file($tempPath, $targetPath)) {
               
                $stmt = $conn->prepare("INSERT INTO Categories (category_name, imag_category, is_desaybelsd) VALUES (?, ?, FALSE)");
                $stmt->bind_param("ss", $cat_name, $photo);

                if ($stmt->execute()) {
                    $stmt->close();
                    
                } else {
                    echo "Error executing query: " . $conn->error;
                }
            } else {
                echo "Error uploading file.";
            }
        }
    }
}
?>


<div class="w-75 container-flude">
    



</div>



<div id="categories"  class=" w-100 mb-5  container-flude" style="">
    <table class="table  container table-bordered">
        <thead class="bg-black text-light ">
            <tr class="table ">
               
                <th class="p-3  border-black" scope="col">category_id</th>
                <th class="p-3  border-black" scope="col">category_name</th>
                <th class="p-3 border-black" scope="col">category_imag</th>
                <th class="p-3  border-black" scope="col">delete/modify</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $categoryQuery = "SELECT * FROM Categories where is_desaybelsd= FALSE";
            $result = $conn->query($categoryQuery);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $categoryid = $row['category_id'];
                    $categoryName = $row['category_name'];
                    $categoryImg = $row['imag_category'];
                    

                    echo '<tr class="justify-content-center">';
                    
                    echo '<td class="border-black p-3">' . $categoryid . '</td>';
                    echo '<td class="border-black p-3" >' . $categoryName . '</td>';
                    echo '<td class="border-black p-3 "><img src="img/' . $categoryImg . '" class="w-25 h-25 " alt="Product Image" ></td>';
                    echo '<td class="border-black p-2 d-flex">
                         
                          <form method="POST" class="Categories-action-form mx-3">
                          <input type="hidden" name="category_id" value="'. $categoryid .'">
                          <a  href="display_cat.php?id='. $categoryid .'" type="submit"  class="btn btn-danger btn-sm w-4 text-light">Disable</a>
                      </form>

                      <form method="POST" class="Categories-action-form mx-3">
                          <input type="hidden" name="category_id" value="'. $categoryid .'">
                          <a  href="modif_cat.php?id='. $categoryid .'" type="submit"  class="btn btn-primary btn-sm w-4 text-light">modifier</a>
                      </form>
                          </td>';
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No categories found</td></tr>";
            }

            
            
            ?>
        </tbody>
    </table>
</div>
    
  <h2 class="text-center bg-dark p-1 text-light container">l'archife</h2>
<div id="categories"  class=" w-100  " style="">
    <table class="table  container table-bordered">
        <thead class="bg-black text-light ">
            <tr class="table ">
                <th class="p-3  border-black" scope="col">ID</th>
                <th class="p-3  border-black" scope="col">category_name</th>
               
                <th class="p-3 border-black" scope="col">category_imag</th>
                <th class="p-3  border-black" scope="col">delete/modify</th>
            </tr>
        </thead>
        <tbody >
            <?php
            $categoryQuery = "SELECT * FROM Categories where is_desaybelsd = TRUE";
            $result = $conn->query($categoryQuery);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $categoryid = $row['category_id'];
                    $categoryName = $row['category_name'];
                    $categoryImg = $row['imag_category'];

                    echo '<tr class="justify-content-center">';
                   
                    echo '<td class="border-black p-3">' . $categoryid . '</td>';
                    echo '<td class="border-black p-3" >' . $categoryName . '</td>';
                    echo '<td class="border-black p-3 "><img src="img/' . $categoryImg . '" class="w-25 h-25 " alt="Product Image" ></td>';
                    echo '<td class="border-black p-2">
                          <form method="POST" class="category-action-form mx-3">
                               <input type="hidden" name="category_name" value="' . $categoryid . '">
                               <a   href="restore_cat.php?id='. $categoryid.'"  class="btn btn-warning btn-sm w-4 text-light">restore</a>
                          </form>
                          </td>';
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No categories found</td></tr>";
            }

           
            
            ?>
        </tbody>
    </table>
</div>
</body>
</html>