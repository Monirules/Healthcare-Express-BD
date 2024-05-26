<?php
session_start();


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
if (isset($_SESSION['admin_id'])) {
    // Retrieve the user ID from the session
    $admin_id = $_SESSION['admin_id'];

    // Prepare the statement
    $query = "SELECT name, email FROM admin WHERE admin_id = ?";
    $stmt = $mysqli->prepare($query);

    // Bind the user ID parameter
    $stmt->bind_param("i", $admin_id);

    // Execute the statement
    $stmt->execute();

    // Bind the result variables
    $stmt->bind_result($name, $email);

    // Fetch the result
    $stmt->fetch();

    // Close the statement
    $stmt->close();
} 


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0sIHeX5vGm/QyQxAW3rpkkfYV/5cOyKRJzpxr0z21OaiFKv09BYhLT5eQsNOF" crossorigin="anonymous">
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
    
        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #343a40;
            padding-top: 20px;
            text-align: center;
        }
        .sidebar h2 {
            color: #fff;
            margin-bottom: 30px;
        }
        .sidebar button {
            display: block;
            width: 80%;
            margin: 10px auto;
            padding: 10px;
            background-color: #68be05;
            border: none;
            border-radius: 5px;
            color: #fff;
            font-size: 17px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .sidebar button:hover {
            background-color: #0056b3;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
        }
    
  </style>
</head>
<body>
    

<!-- Sidebar -->
<div class="sidebar">
    <h2>Admin Panel</h2><br>
    <button onclick="window.location.href='admin_dashboard.php'">Homepage</button>
    <button onclick="window.location.href='manage_user.php'">Manage Users</button>
    <button onclick="window.location.href='manage_doctors.php'">Manage Doctors</button>
    <button onclick="window.location.href='manage_schedules.php'">Manage Schedules</button>
    <button onclick="window.location.href='manage_medicine_requests.php'"> Medicine Requests</button>
    <form action="../admin_login.html" method="post">
        <button type="submit" name="logout">Logout</button>
    </form>
</div>

<!-- Page content -->
<div class="content alert alert-secondary" role="alert">
    Welcome <?php echo $name; ?>!
<br>

</div>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="content">
                <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active" data-bs-interval="2500">
                            <img src="../img/cover1.png" class="d-block w-100" alt="First slide">
                        </div>
                        <div class="carousel-item" data-bs-interval="2500">
                            <img src="../img/cover2.png" class="d-block w-100" alt="Second slide">
                        </div>
                        <!-- Add more carousel items as needed -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<br><br>
    
  

<!-- Bootstrap Bundle with Popper -->





<!-- Footer -->
<footer class="footer bg-dark text-white text-center py-3">
    <div class="container">
      <span>&copy; 2024 - HealthCare Xpress</span>
    </div>
  </footer>

  <!-- JavaScript and dependencies -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-D1oLYG3o7vAn1/K/45VnysXAb5PG0s+NC3HIw5f3lXjI3aFKtf1Ma1CJZzgwX+2Q" crossorigin="anonymous"></script>
</body>
</html>