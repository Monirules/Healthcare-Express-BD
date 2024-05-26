<?php
session_start();

error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);

// Check if the user is logged in
if (!isset($_SESSION["id"])) {
    header("Location: login.php");
    exit();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    // Retrieve form data
    $id = $_SESSION["id"]; 
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    // Update user data in the database
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

    // Update user data
    $query = "UPDATE user SET name=?, email=?, phone=? WHERE id=?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("sssi", $name, $email, $phone, $id);
    $stmt->execute();

    // Check if the update was successful
    if ($stmt->affected_rows > 0) {
        // Update successful
        header("Location: profile.php");
        exit();
    } else {
        // Update failed
        echo '<div class="alert alert-danger"><strong>Error!</strong> Failed to update profile.</div>';
    }

    // Close the statement and connection
    $stmt->close();
    $mysqli->close();
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/css/bootstrap.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/css/style.css">
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Update Profile
                </div>
                <div class="card-body">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="" value="<?php echo $name; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $phone; ?>" required>
                        </div>
                        <!-- Add other fields here if needed -->
                        <button type="submit" name="update" class="btn btn-primary">Update</button>
                        <a href="profile.php" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



</body>
</html>