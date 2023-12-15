<?php // Replace these with your actual database credentials
$servername = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'electronacerv3';

// Create connection
$conn = new mysqli($servername, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
