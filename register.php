<?php
session_start(); // Start the session
include 'connex_db.php'; // Include your database connection file
require 'UserDAO.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user input
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $fulname = $_POST["fulname"];
    $adress = $_POST["adress"];
    $phone = $_POST["phone"];
    $city = $_POST["city"];
    $user= new user(0,$username, $email, $password,'user', FALSE,$fulname, $phone,$adress,FALSE,$city );  
    $users =new UserDAO();
    try {
        $dataexsist= $users->get_chaked_user($email , $password );

        if (!$dataexsist) {
        $result = $users->insert_users($user);
        
        if ($result) {
            // Registration successful, redirect to login page
            header("Location: index.php");
            exit();
        } }
    } catch (Exception $e) {
       echo "<script>alert(' this user is allredy exist. try another acount ')</script>";
           
   }

}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Register</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3 mt-5">
                    <h3 class="text-center mb-4">Register</h3>

                    <?php
                    if (isset($error_message)) {
                        echo '<div class="alert alert-danger" role="alert">' . $error_message . '</div>';
                    }
                    ?>

                    <form method="post">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="fulname" class="form-label">full name</label>
                            <input type="text" class="form-control" id="fulname" name="fulname" required>
                        </div>
                        <div class="mb-3">
                            <label for="adress" class="form-label">adress</label>
                            <input type="text" class="form-control" id="adress" name="adress" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">phone number</label>
                            <input type="number" class="form-control" id="phone" name="phone" required>
                        </div>
                        <div class="mb-3">
                            <label for="city" class="form-label">city</label>
                            <input type="text" class="form-control" id="city" name="city" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Register</button>
                    </form>

                    <p class="mt-3">Already have an account? <a href="index.php">Login here</a></p>
                </div>
            </div>
        </div>
    </section>

    <?php
    include("footer.php")
    ?>