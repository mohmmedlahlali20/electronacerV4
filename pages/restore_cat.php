
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    include('db_cnx.php');
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $delete_cat = "UPDATE Categories SET is_desaybelsd = FALSE WHERE category_id = $id";

    if ($conn->query($delete_cat) === TRUE) {
        header("Location: category-management.php");
        exit();     
    } else {
        echo "Error deleting category: " . $conn->error;
    }
}

?>
</body>
</html>