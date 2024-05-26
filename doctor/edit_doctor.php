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
    $query = "SELECT * FROM doctor WHERE doctor_id=?";
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
    $category = $_POST['category'];
    $room_no = $_POST['room_no'];
    $schedule = $_POST['schedule'];
    $schedule2 = $_POST['schedule2'];

    // Update doctor data in the database
    $query = "UPDATE doctor SET name=?, email=?, category=?, room_no=?, schedule=?, schedule2=? WHERE doctor_id=?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("ssssssi", $name, $email, $category, $room_no, $schedule, $schedule2, $id);
    $stmt->execute();

    // Redirect to doctor dashboard after update
    header("Location: doctor_dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Doctor Profile</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Doctor Profile</h2>
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
                <label for="category">Category:</label>
                <input type="text" class="form-control" id="category" name="category" value="<?php echo $doctor['category']; ?>" required>
            </div>
            <div class="form-group">
                <label for="room_no">Room No:</label>
                <input type="text" class="form-control" id="room_no" name="room_no" value="<?php echo $doctor['room_no']; ?>" required>
            </div>
            <div class="form-group">
                <label for="schedule">Schedule 1:</label>
                <input type="text" class="form-control" id="schedule" name="schedule" value="<?php echo $doctor['schedule']; ?>" required>
            </div>
            <div class="form-group">
                <label for="schedule2">Schedule 2:</label>
                <input type="text" class="form-control" id="schedule2" name="schedule2" value="<?php echo $doctor['schedule2']; ?>" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            <a href="doctor_dashboard.php" class="btn btn-secondary">Cancel</a>
        </form>
   
