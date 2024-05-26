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
if (isset($_SESSION['emergency_id'])) {
    // Retrieve the user ID from the session
    $id = $_SESSION['emergency_id'];

    // Prepare the statement
    $query = "SELECT name, email, password, address, phone, price FROM emergency WHERE emergency_id= ?";
    $stmt = $mysqli->prepare($query);

    // Bind the user ID parameter
    $stmt->bind_param("i", $id);

    // Execute the statement
    $stmt->execute();

    // Bind the result variables
    $stmt->bind_result($name, $email, $password, $address, $phone, $price);

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
    <title>Emergency Ambulance</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0sIHeX5vGm/QyQxAW3rpkkfYV/5cOyKRJzpxr0z21OaiFKv09BYhLT5eQsNOF" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
  <style>
        .footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 60px; /* Height of the footer */
            background-color: #031653; /* Adjust as needed */
            color: white; /* Adjust as needed */
        }
    
        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #031653;
            padding-top: 20px;
            text-align: center;
        }
        .sidebar h2 {
            color: #ffffff;
            margin-bottom: 50px;
            margin-top: 20px;
        }
        .sidebar button {
            display: block;
            width: 80%;
            margin: 10px auto;
            padding: 10px;
            background-color: #079ecc;
            border: none;
            border-radius: 5px;
            color: #fff;
            font-size: 17px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .sidebar button:hover {
            background-color: #081bc5;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
        }
        .table{
            width: 40%;
            margin: 0 auto;
            margin-top: 5%;
        }
    
  </style>
</head>
<body>


<!-- Sidebar -->
<div class="sidebar"><br>
    <h5 style="color: #fff;"> Ambulance 🚨 </h5><br><br>
    <button onclick="window.location.href='emergency_dashboard.php'">Homepage</button>

    <a href="edit_emergency.php?id=<?php echo $_SESSION['emergency_id']; ?>" ><button>Edit Profile</button></a>

    <button onclick="window.location.href='manage_emergency_schedules.php'">Manage Schedules</button>
    
    
    <form action="emergency_login.html" method="post">
        <button type="submit" name="logout">Logout</button>
    </form>
</div>

<!-- Page content -->
<div class="content alert" style="background-color: #031653; color: #fff;" role="alert">
    Welcome <?php echo $name; ?> !
<br>

</div>

<div class="content">
    <h3 style="text-align: center; color:brown; margin-top: 3%;">Driver Profile</h3>

    <table class="table table-striped table-hover">
        
        <tbody>
          <tr>
            <td><b>Name: </b></td>
            <td><?php echo $name; ?></td>
          </tr>

          <tr>
            <td><b>Email:</b></td>
            <td><?php echo $email; ?></td>
          </tr>

          <tr>
            <td><b>Password:</b></td>
            <td><?php echo $password; ?></td>
          </tr>

          <tr>
            <td><b>Address:</b></td>
            <td><?php echo $address; ?></td>
          </tr>

          <tr>
            <td><b>Phone:</b></td>
            <td><?php echo $phone; ?></td>
          </tr>

          <tr>
            <td><b>Price:</b></td>
            <td><?php echo $price; ?></td>
          </tr>

   
          
        </tbody>
      </table>

  </div>

<!-- Bootstrap Bundle with Popper -->





<!-- Footer -->
<footer class="footer text-center py-3">
    <div class="container">
      <span>&copy; 2024 - HealthCare Xpress</span>
    </div>
  </footer>

  <!-- JavaScript and dependencies -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-D1oLYG3o7vAn1/K/45VnysXAb5PG0s+NC3HIw5f3lXjI3aFKtf1Ma1CJZzgwX+2Q" crossorigin="anonymous"></script>
</body>
</html>