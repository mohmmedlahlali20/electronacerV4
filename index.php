<?php
session_start();
include 'connex_db.php'; // Include your database connection script
include 'UserDAO.php';
$users = new UserDAO();


$user=[];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $result= $users-> get_chaked_user($email , $password );
    
    

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         

        if ($user["verified"]) {
            // User is verified, proceed with login
            $_SESSION["user"] = $user;

            if ($user["role"] == "admin") {
                header("Location: admin_dashboard.php"); // Redirect to admin dashboard
            } else {
                header("Location: home.php"); // Redirect to user account page
            }

            exit();
        } else {
            // User is not verified, redirect to unverified page
            header("Location: unverified.php");
            exit();
        }
    } else {
        $error_message = "Invalid login credentials or account disabled";
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title></title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />

    <!-- fontawesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha256-hk1J8HZqEW/p7zC0xjYYr4EhGtYszmJdz21pKBC7ROU=" crossorigin="anonymous" />
    <link rel="icon" href="img/electric.png">
</head>
<style>

body{
    /* background-image: url(./img/pic3.jpg); */
            background: linear-gradient(90deg, rgba(30, 0, 0) 0%, rgba(9,9,121,1) 50%, rgba(30,0,0) 100%);
  background-size: cover;
}
h3 {
    color: #D4D4D4;
    font-size: 8rem;
    font-family: "Times New Roman", Times, serif;
}
.dir{
  position: relative;
  animation: mymove 1s;
  animation-fill-mode: forwards;
}
#div1 {animation-timing-function: linear;}
#div2 {animation-timing-function: ease;}
#div3 {animation-timing-function: ease-in-out;}
@keyframes mymove {
  from {left: -500px;}
  to {left: 0px;}

}
</style>

<body>
    <!--Write your code here -->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3 mt-5">
                    <h3 class="text-center mb-4" style="margin-top: 10%;">Login</h3>

                    <?php
                    if (isset($error_message)) {
                        echo '<div class="alert alert-danger" role="alert">' . $error_message . '</div>';
                    }
                    ?>

                    <form method="post">
                        <div id="div1" class="dir" style="margin-top: 10%;">
                            <label style="color: #D4D4D4;" for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div id="div2" class="dir mb-3" style="margin-top: 5%;">
                            <label for="password" class="form-label" style="color: #D4D4D4;">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button style="margin-top: 5%;" id="div3" type="submit" class="btn btn-primary dir">Login</button>
                    </form>

                    <p class="mt-3" style="color: #D4D4D4;">Don't have an account? <a href="register.php">Register
                            here</a></p>
                </div>
            </div>
        </div>
    </section>
    <!--Write your code here -->
    <?php
    include("footer.php")
    ?>