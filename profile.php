<?php
// Start or resume session
session_start();

// Assuming you have already established a database connection
error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);

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

// Check if user is logged in and if their ID is set in the session
if (isset($_SESSION['id'])) {
    // Retrieve the user ID from the session
    $id = $_SESSION['id'];

    // Prepare the statement
    $query = "SELECT name, email, phone FROM user WHERE id = ?";
    $stmt = $mysqli->prepare($query);

    // Bind the user ID parameter
    $stmt->bind_param("i", $id);

    // Execute the statement
    $stmt->execute();

    // Bind the result variables
    $stmt->bind_result($name, $email, $phone);

    // Fetch the result
    $stmt->fetch();

    // Close the statement
    $stmt->close();
} else {
    // Redirect to login page or handle unauthorized access
    header("Location: index.html");
    exit();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Profile</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="styles.css">
  <style>
    .footer {
        position: absolute;
        bottom: 0;
        width: 100%;
        height: 60px; /* Height of the footer */
        background-color: #343a40; /* Adjust as needed */
        color: white; /* Adjust as needed */
    }
  </style>
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="home.html">HealthCare Xpress</a>
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

  <!-- User Profile -->


<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card text-center">
                <div class="card-header">
                    User Profile
                </div>
                <div class="card-body">
                    <!-- User Image -->
                    <img src="img/user.png" class="img-fluid rounded-circle mb-3" alt="User Image" style="width: 200px; height: 200px;">
                    <!-- User Info -->
                    <h5 class="card-title"><?php echo $name; ?></h5>
                    <p class="card-text">Email: <?php echo $email; ?></p>
                    <p class="card-text">Phone: <?php echo $phone; ?></p>
                    <p class="card-text">Address: Bashundhara R/A, Dhaka.</p>
                    <!-- Update Profile Button -->
                    <a href="update_profile.php?id=<?php echo $_SESSION['id']; ?>"  class="btn btn-primary">Update Profile</a>
                </div>
            </div>
        </div>
    </div>
</div>



  <!-- Footer -->
  <footer class="footer bg-dark text-white text-center py-3">
    <div class="container">
      <span>&copy; 2024 - HealthCare Xpress</span>
    </div>
  </footer>

  <!-- JavaScript and dependencies -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
