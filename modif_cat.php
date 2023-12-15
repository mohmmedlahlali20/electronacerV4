<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/font/bootstrap-icons.min.css"
        integrity="sha512-oAvZuuYVzkcTc2dH5z1ZJup5OmSQ000qlfRvuoTTiyTBjwX1faoyearj8KdMq0LgsBTHMrRuMek7s+CxF8yE+w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
    <form class="form-section" method="post" enctype="multipart/form-data">
        <div class="form-group mb-3 w-50 mx-5">
            <label for="name_category">new name</label>
            <input type="text" id="name_category" class="form-control" name="name_cat">

        </div>

        <div class="form-group mb-3 w-50 mx-5">
            <label for="img_category">new photo</label>
            <input type="file" id="img_category" class="form-control" name="file">
        </div>
        <button type="submit" name="submit" class="btn btn-primary text-light mx-4">modifier votre category</button>
    </form>
    <?php
 include('db_cnx.php');

 if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_GET["id"];
    $categoryQuery = "SELECT * FROM Categories WHERE category_id=$id";

    if (isset($_POST['name_cat'],  $_FILES['file'])) {
        $cat_name = $_POST['name_cat'];
       
        $photo = basename($_FILES['file']['name']);
        $targetPath = './img/' . $photo;
        $tempPath = $_FILES['file']['tmp_name'];

        if (move_uploaded_file($tempPath, $targetPath)) {
            $category_id = $_GET['id'];
            $conn->query("UPDATE Categories SET category_name='$cat_name',  imag_category='$photo' WHERE category_id=$category_id");

            header("Location: category-management.php");
            exit();
        }
    }
}


?>
</body>

</html>