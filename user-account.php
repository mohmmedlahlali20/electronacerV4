<?php
session_start(); // Start the session
include 'db_cnx.php'; // Include your database connection file

// Check if the user is logged in
if (!isset($_SESSION['user'])) {
    // Redirect to the login page if not logged in
    header("Location: login.php");
    exit();
}

// Get user role from the session
$userRole = $_SESSION['user']['role'];

// Fetch user information from the database
$userId = $_SESSION['user']['user_id'];
$userSql = "SELECT * FROM Users WHERE user_id = '$userId'";
$userResult = $conn->query($userSql);

// Check if the user exists
if ($userResult->num_rows > 0) {
    $userData = $userResult->fetch_assoc();
} else {
    echo "User not found.";
    exit();
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Info</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="stylehind.css">
    <link rel="icon" href="img/electric.png">

    <!-- Custom CSS for styling -->
</head>

<body>
    <!-- Navigation Bar -->
    <?php
        include("nav.php")
    ?>


  <!-- user card (informations) -->

<div class="carte container d-flex justify-content-around" style="margin-left: -5px;" >
<div class="carde">
     <img style="width: 80%; margin-top: -8%; margin-left: -1%;"  src="./img/pic2.png" alt="">
    </div>
   <div class="card w-100 h-200" style="padding: 20px; margin-left: -30%; ">
       <div class="row m-l-0 m-r-0">
           <div class="col-sm-4 bg-c-lite-green" style="margin-left: 14%; border-radius: 80px; height: 300px; width: 600px;">
               <div class="carte card-block text-center text-white" style="margin-top: 5%;">
                   <div class="m-b-25">
                       <img src="https://img.icons8.com/bubbles/100/000000/user.png" class="img-radius" alt="User-Profile-Image">
                   </div>
                   <h6 class="f-w-600" style="text-decoration: underline;"> <?php echo $userData['full_name']; ?></h6>
                   <p class="user-details">User ID: <?php echo $userData['user_id']; ?></p>
                   <i class=" mdi mdi-square-edit-outline feather icon-edit m-t-10 f-16"></i>
               </div>
           </div>
           <div class="col-sm-8" style="margin-bottom: 50px; margin-left: 25%" >
               <div class="card-block">
                   <div class="row" style="margin-top: 10%;">
                       <div class="col-sm-6" >
                           <p style="font-size: 1.6rem;" >Email :</p>
                           <h6 class="text-muted f-w-400" style="font-size: 20px;"><?php echo $userData['email']; ?></h6>
                       </div>
                       <div class="col-sm-6">
                           <p style="font-size: 1.6rem;">Phone :</p>
                           <h6 class="text-muted f-w-400" style="font-size: 20px;"> <?php echo $userData['phone_number']; ?></h6>
                       </div>
                       <div class="col-sm-6">
                           <p style="font-size: 1.6rem;">Address :</p>
                           <h6 class="text-muted f-w-400" style="font-size: 20px;"><?php echo $userData['address']; ?></h6>
                       </div>
                       <div class="col-sm-6">
                           <p style="font-size: 1.6rem;">City :</p>
                           <h6 class="text-muted f-w-400 " style="font-size: 20px;" ><?php echo $userData['city']; ?></h6>
                       </div>
                   </div>
                  
               </div>
           </div>
       </div>
    </div>
    
   </div>
 



    <!-- Bootstrap JS (Optional) -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>