<?php

error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
session_start();

$con = mysqli_connect('localhost', 'root', '', 'healthcare_xpress');

$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$password = $_POST['password'];

// Prepare SQL statement to prevent SQL injection
$s = "SELECT * FROM `user` WHERE email = ? AND password = ?";
$stmt = mysqli_prepare($con, $s);
mysqli_stmt_bind_param($stmt, 'ss', $email, $password);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$num = mysqli_num_rows($result);

if ($num == 1) {
    echo "Email Already Taken; Try another email!";
} else {
    // Prepare SQL statement for insertion
    $reg = "INSERT INTO `user` (`name`, `phone`, `email`, `password`) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($con, $reg);
    mysqli_stmt_bind_param($stmt, 'ssss', $name, $phone, $email, $password);
    
    // Execute the statement
    $success = mysqli_stmt_execute($stmt);
    
    if ($success) {
        echo "Registration Successful!";
        header('location:index.html');
    } else {
        echo "Error: " . mysqli_error($con);
    }
}

mysqli_close($con);

?>
