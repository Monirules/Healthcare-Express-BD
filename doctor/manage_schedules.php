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
            width: 100%;
            margin: 0 auto;
            
        }
    
  </style>
</head>
<body>
    

<!-- Sidebar -->
<div class="sidebar">
    <h2>Doctors Panel</h2>
    <button onclick="window.location.href='doctor_dashboard.php'">Homepage</button>
    <a href="edit_doctor.php?id=<?php echo $_SESSION['doctor_id']; ?>" ><button>Edit Profile</button></a>


    <button onclick="window.location.href='manage_schedules.php'">Manage Schedules</button>
    
    <button onclick="window.location.href='search_doctors.php'">Search Doctors</button>
    <form action="../doctor_login.html" method="post">
        <button type="submit" name="logout">Logout</button>
    </form>
</div>

<!-- Page content -->
<div class="content alert" style="background-color: #031653; color: #fff;" role="alert">
    Welcome Doctor!
<br>

</div>

<div class="content">
    

<div class="container mt-5">
    <h2 class="text-center mb-4" style="color:rgb(88, 114, 44);">Manage Schedules</h2><br>
    <table class="table">
        <thead>
            <tr>
                
                <th scope="col">Name</th>
                <th scope="col">Phone</th>
                <th scope="col">Address</th>
                <th scope="col">Doctor</th>
                <th scope="col">Schedule</th>
                <th scope="col">Paid (BDT)</th>
                <th scope="col">Action</th>
               
            </tr>
        </thead>
        <tbody>
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

            $query = "SELECT * FROM doctor_appointment WHERE doctor_id = {$_SESSION['doctor_id']}";
$result = $mysqli->query($query);


            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['contact_no'] . "</td>";
                    echo "<td>" . $row['address'] . "</td>";
                    echo "<td>" . $row['doctor_name'] . "</td>";
                    echo "<td>" . $row['schedule'] . "</td>";
                    echo "<td>" . $row['total_price'] . "</td>";
                    echo '<td><button type="button" class="btn btn-success  btn-sm" onclick="callAmbulance()">Call</button></td>';
                    echo '<td>';
                
                }
            } else {
                echo "<tr><td colspan='6'>No appointment found!</td></tr>";
            }
            ?>
        </tbody>
    </table>

    
</div>


  </div>

<!-- Bootstrap Bundle with Popper -->





<!-- Footer -->
<footer class="footer  text-white text-center py-3">
    <div class="container">
      <span>&copy; 2024 - HealthCare Xpress</span>
    </div>
  </footer>

  <!-- JavaScript and dependencies -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-D1oLYG3o7vAn1/K/45VnysXAb5PG0s+NC3HIw5f3lXjI3aFKtf1Ma1CJZzgwX+2Q" crossorigin="anonymous"></script>
  <script>
    function callAmbulance() {
        
        alert("Calling patient..."); // Example alert message
    }
</script>

</body>
</html>