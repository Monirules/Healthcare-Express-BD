<?php
session_start();


// Assuming you have already established a database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "healthcare_xpress";

// Create connection
$mysqli = new mysqli($servername, $username, $password, $database);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Check if doctor ID is provided
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Retrieve doctor details from database
    $query = "SELECT * FROM emergency WHERE emergency_id=?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $doctor = $result->fetch_assoc();

} 

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $price = $_POST['price'];

    // Update doctor data in the database
    $query = "UPDATE emergency SET name=?, email=?, password=?, address=?, phone=?, price=? WHERE emergency_id=?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("ssssssi", $name, $email, $password, $address, $phone, $price, $id);
    $stmt->execute();

    // Redirect to doctor dashboard after update
    header("Location: emergency_dashboard.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Driver Profile</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2 style="color: rgb(56, 114, 223);">Edit Driver Profile</h2><hr><br>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $id; ?>" method="post">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $doctor['name']; ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $doctor['email']; ?>" required>
            </div>
            <div class="form-group">
                <label for="category">Password:</label>
                <input type="text" class="form-control" id="password" name="password" value="<?php echo $doctor['password']; ?>" required>
            </div>
            <div class="form-group">
                <label for="room_no">Address:</label>
                <input type="text" class="form-control" id="address" name="address" value="<?php echo $doctor['address']; ?>" required>
            </div>
            <div class="form-group">
                <label for="schedule">Phone:</label>
                <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $doctor['phone']; ?>" required>
            </div>
            <div class="form-group">
                <label for="schedule2">Price:</label>
                <input type="text" class="form-control" id="price" name="price" value="<?php echo $doctor['price']; ?>" required>
            </div>
            <a href="emergency_dashboard.php" class="btn btn-danger">Cancel</a>
            <button type="submit" name="submit" class="btn btn-success">Submit</button>
            
        </form>
   
