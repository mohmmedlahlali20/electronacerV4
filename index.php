<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Your Combined Page</title>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="icon" href="img/electric.png">

</head>

<body>

  <?php
  // Check if a page parameter is set in the URL
  if (isset($_GET['page'])) {
    $page = $_GET['page'];

    // Validate and include the selected page
    if (in_array($page, ['login', 'register']) && file_exists($page . '.php')) {
      include($page . '.php');
    } else {
      echo '<p class="alert alert-danger">Invalid page selected.</p>';
    }
  } else {
    // Default page to include when no specific page is selected
    include('login.php');
  }
  ?>
  <?php
  include("footer.php")
  ?>