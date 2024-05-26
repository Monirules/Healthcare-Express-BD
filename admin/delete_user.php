<?php
session_start();

// Assuming you have established a database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "healthcare_xpress";
$mysqli = new mysqli($servername, $username, $password, $database);

// Check if the user is logged in

// Check if the user wants to delete a user
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    // Retrieve user ID from URL
    $id = $_GET['id'];
    
    // Delete user from the database
    $query = "DELETE FROM user WHERE id=?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    
    // Redirect to manage users page
    header("Location: manage_user.php");
    exit();
} 

// Check if the user wants to delete a doctor
elseif ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['doctor_id'])) {
    // Retrieve doctor ID from URL
    $id = $_GET['doctor_id'];
    
    // Delete doctor from the database
    $query = "DELETE FROM doctor WHERE doctor_id=?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    
    // Redirect to manage doctors page
    header("Location: manage_doctors.php");
    exit();
} 

// Redirect to manage users page if no ID is provided or if the request method is not GET
else {
    header("Location: manage_doctors.php");
    exit();
}
?>
