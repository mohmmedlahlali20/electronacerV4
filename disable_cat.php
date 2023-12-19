<?php
require_once 'categoryDAO.php';
require_once 'connexion.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    if (isset($_GET["id"])) {
        $id = $_GET["id"];

        $conn = DataBase::getInstance();
        $update_query = new CategoryDAO();
        $update_query->delete_category($id);

        if ($update_query->delete_category($id) == true) {
            header("Location: admin-dashboard.php?page=category-management");
            exit();
        }
    }
    ?>
</body>

</html>