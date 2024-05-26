<?php
session_start();

error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);

$con = mysqli_connect('localhost', 'root');
mysqli_select_db ($con,'healthcare_xpress');

$email = $_POST['email'];
$password = $_POST['password'];

$s = "SELECT* from emergency where email='$email' && password='$password'";

$result = mysqli_query($con, $s);
$num = mysqli_num_rows($result);
$_SESSION["status"] = false;

if($num == 1){
    $row = mysqli_fetch_assoc($result);
    $emergency_id = $row['emergency_id'];

    $_SESSION["emergency_id"] = $emergency_id;
    $_SESSION["status"] = true;
    header('location:emergency_dashboard.php');
}
else{
    
    header('location:emergency_login.html');
    echo '<div class="alert alert-danger"><strong>Wrong credintials!</strong></div>';
}

?>