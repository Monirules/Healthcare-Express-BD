<?php
// Start the session
session_start();

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize form inputs
    $name = htmlspecialchars($_POST['name']);
    $address = htmlspecialchars($_POST['address']);
    $phone = htmlspecialchars($_POST['phone']);
    $driver_name = isset($_POST['driver_name']) ? htmlspecialchars($_POST['driver_name']) : null;

    // Connect to your MySQL database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "healthcare_xpress";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the user name already exists in the emergency_submission table
    $sql_check = "SELECT * FROM emergency_submission WHERE user_name = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("s", $name);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        // User name already exists, show an error message
        $_SESSION['error'] = "The name '$name' is already used. Please use a different name.";
    } else {
        // Query to get driver details based on selected driver name
        $sql = "SELECT * FROM emergency WHERE name = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $driver_name);
        $stmt->execute();
        $result = $stmt->get_result();
        $driver_details = $result->fetch_assoc();

        // Insert user and driver details into 'emergency_submission' table
        $sql_insert = "INSERT INTO emergency_submission (user_name, user_address, user_phone, emergency_id, driver_name, driver_email, driver_address, driver_phone, driver_price) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt_insert = $conn->prepare($sql_insert);
        $stmt_insert->bind_param("sssssssss", $name, $address, $phone, $driver_details['emergency_id'], $driver_details['name'], $driver_details['email'], $driver_details['address'], $driver_details['phone'], $driver_details['price']);
        $stmt_insert->execute();

        // Close prepared statement and database connection
        $stmt->close();
        $stmt_insert->close();
        $conn->close();

        // Redirect to a thank you page or any other page as per your requirement
        header("Location: emergency_ambulance.php");
        exit;
    }
}
?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Emergency</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>


    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="home.php">HealthCare Xpress</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="home.php">Home</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="profile.php">Profile</a>
              </li>
              <li class="nav-item dropdown active">
                <a class="nav-link dropdown-toggle" href="medicine.html" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Medicine
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="Antibiotics.html">Antibiotics </a>
                  <a class="dropdown-item" href="Antacids.html">Antacids </a>
                  <a class="dropdown-item" href="Antipyretics.html">Antipyretics</a>
                  <a class="dropdown-item" href="Antidiabetics.html">Antidiabetics</a>
                  <a class="dropdown-item" href="Antidepressants.html">Antidepressants</a>
                </div>
            </li>
            
            <li class="nav-item dropdown active">
              <a class="nav-link dropdown-toggle" href="appointment.html" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Appointment
              </a>
              
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="general.php">General Physician </a>
                  <a class="dropdown-item" href="Gastroenterologist.php">Gastroenterologist  </a>
                  <a class="dropdown-item" href="Cardiologist.php">Cardiologist </a>
                  <a class="dropdown-item" href="Dermatologist.php">Dermatologist </a>
                
            </div>
          </li>
            <li class="nav-item active">
              <a class="nav-link" href="emergency_ambulance.php">Emergency</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="live_consultant.php">Live Consultant</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="cart.php" style="color: rgb(236, 253, 0); font-weight: bold;">Cart</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="index.html">Logout</a>
              </li>
          </ul>
        </div>
      </nav>
    
    <br><br><br>



<div class="container mt-5">
    <h2>Submit Emergency</h2>
    <hr><br>
    <?php
    if (isset($_SESSION['error'])) {
        echo "<div class='alert alert-danger' role='alert'>" . $_SESSION['error'] . "</div>";
        unset($_SESSION['error']);
    }
    ?>


    <form action="submit_emergency.php" method="POST">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone:</label>
            <input type="text" class="form-control" id="phone" name="phone" required>
        </div>
        <div class="form-group">
            <label for="address">Address:</label>
            <input type="text" class="form-control" id="address" name="address" required>
        </div>
        <div class="form-group">
            <label for="driver_name">Select Driver:</label>
            <select class="form-control" id="driver_name" name="driver_name" required>
                <option value="">Select Driver</option>
                <?php
                // Connect to your MySQL database
                $servername = "localhost";
                $username = "root";
                $password = "";
                $database = "healthcare_xpress";

                // Create connection
                $conn = new mysqli($servername, $username, $password, $database);

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                // Assuming you have already established a database connection
                $sql = "SELECT name FROM emergency";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row["name"] . "'>" . $row["name"] . "</option>";
                    }
                } else {
                    echo "<option disabled>No drivers available</option>";
                }
                ?>
            </select>
        </div><br>
        <a href="emergency_ambulance.php" class="btn btn-danger">Cancel</a>
        <button type="submit" class="btn btn-success">Submit</button>
    </form>
</div>

</body>
</html>
