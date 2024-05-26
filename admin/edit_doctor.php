<?php
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $id = $_POST['doctor_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $room_no = $_POST['room_no'];
    $schedule = $_POST['schedule'];
    $schedule2 = $_POST['schedule2'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Update user data
    $query = "UPDATE doctor SET name=?, description=?, category=?, room_no=?, schedule=?, schedule2=?, email=?, password=? WHERE doctor_id=?";
    
    $stmt = $mysqli->prepare($query);
    if ($stmt) {
        $stmt->bind_param("ssssssssi", $name, $description, $category, $room_no, $schedule, $schedule2, $email, $password, $id);
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            // Redirect to manage users page
            header("Location: manage_doctors.php");
            exit();
        } else {
            echo "Failed to update doctor information: " . $stmt->error;
        }
    } else {
        echo "Error preparing statement: " . $mysqli->error;
    }
    
    // Redirect to manage users page
    //header("Location: manage_doctors.php");
    exit();
} elseif ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    // Retrieve user details from database
    $id = $_GET['id'];
    $query = "SELECT * FROM doctor WHERE doctor_id=?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
} else {
    // Redirect to manage users page if no ID is provided
    header("Location: manage_doctors.php");
    exit();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <!-- Add your CSS and Bootstrap links here -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container mt-5 mb-5">
        <h2 class="text-center">Edit Doctor</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="hidden" name="doctor_id" value="<?php echo $user['doctor_id']; ?>">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $user['name']; ?>" required>
            </div>
            <div class="form-group">
                <label for="name">Description:</label>
                <input type="text" class="form-control" id="description" name="description" value="<?php echo $user['description']; ?>" required>
            </div>
            <div class="form-group">
                <label for="name">Category:</label>
                <input type="text" class="form-control" id="category" name="category" value="<?php echo $user['category']; ?>" required>
            </div>
            <div class="form-group">
                <label for="name">Room No:</label>
                <input type="text" class="form-control" id="room_no" name="room_no" value="<?php echo $user['room_no']; ?>" required>
            </div>
            <div class="form-group">
                <label for="phone">Schedule:</label>
                <input type="text" class="form-control" id="schedule" name="schedule" value="<?php echo $user['schedule']; ?>" required>
            </div>
            <div class="form-group">
                <label for="phone">Schedule 2:</label>
                <input type="text" class="form-control" id="schedule2" name="schedule2" value="<?php echo $user['schedule2']; ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $user['email']; ?>" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" value="<?php echo $user['password']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
            <a href="manage_doctors.php" class="btn btn-secondary">Cancel</a>
        </form>

        
    </div>
</body>
</html>
