<?php
// Check if medicine ID is provided in the URL
if (isset($_GET['doctor']) && is_numeric($_GET['doctor'])) {
    // Medicine ID retrieved from URL
    $doctor_id = $_GET['doctor'];

    // Database connection parameters
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "healthcare_xpress";
    $table = "doctor";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL statement to fetch medicine details
    $sql = "SELECT * FROM $table WHERE doctor_id = $doctor_id";

    // Execute SQL query
    $result = $conn->query($sql);

    // Check if medicine details are found
    if ($result->num_rows > 0) {
        // Medicine details fetched successfully
        $medicine = $result->fetch_assoc();
    } else {
        // No medicine found with the provided ID
        echo "<p>No Doctor found with the provided ID.</p>";
        exit; // Stop further execution
    }

    // Close database connection
    $conn->close();
} else {
    // Medicine ID is missing or invalid
    echo "<p>Invalid doctor ID.</p>";
    exit; // Stop further execution
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Appointment</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="home.html">HealthCare Xpress</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <a class="nav-link" href="home.html">Home</a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="profile.html">Profile</a>
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
            <a class="nav-link dropdown-toggle" href="general.html" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Appointment
            </a>
            
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="general.html">General Physician </a>
              <a class="dropdown-item" href="general.html">Gastroenterologist  </a>
              <a class="dropdown-item" href="general.html">Cardiologist </a>
              <a class="dropdown-item" href="general.html">Dermatologist </a>
              
          </div>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="emergency_ambulance.html">Emergency</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="live_consultant.php">Live Consultant</a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="index.html">Logout</a>
          </li>
      </ul>
    </div>
  </nav>
  <br><br>

    <h2 style="margin-top: 4%; text-align: center;color:chocolate;">Doctor Appointment Form</h2>
    
    <div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="appointment_success.php" method="post">
                <input type="hidden" name="doctor_id" value="<?php echo $medicine['doctor_id']; ?>">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                
                <div class="form-group">
                    <label for="contact_no">Contact No:</label>
                    <input type="text" class="form-control" id="contact_no" name="contact_no" required>
                </div>

                <div class="form-group">
                    <label for="address">Address:</label>
                    <input type="text" class="form-control" id="address" name="address" required>
                </div>

                <div class="form-group">
                    <label for="doctor_name">Doctor Name:</label>
                    <input type="text" class="form-control" id="doctor_name" name="doctor_name" value="<?php echo $medicine['name']; ?>" readonly>
                </div>

                <div class="form-group">
                    <label for="category">Doctor Category:</label>
                    <input type="text" class="form-control" id="category" name="category" value="<?php echo $medicine['category']; ?>" readonly>
                </div>

                <div class="form-group">
                    <label for="doctor_description">Doctor Description:</label>
                    <input type="text" class="form-control" id="doctor_description" name="doctor_description" value="<?php echo $medicine['description']; ?>" readonly>
                </div>

                
                <div class="form-group">
                    <label for="schedule">Schedule Timing:</label>
                    <select class="form-select" aria-label="Default select example" id="schedule" name="schedule">
                    
                    <option value="<?php echo $medicine['schedule']; ?>" selected id="schedule" name="schedule"><?php echo $medicine['schedule']; ?></option>
                   
                    <option value="<?php echo $medicine['schedule2']; ?>" id="schedule" name="schedule"><?php echo $medicine['schedule2']; ?></option>
                    
                    </select>
                </div>
                <div class="form-group">
                    <label for="total_price">Total Price:</label>
                    <input type="text" class="form-control" id="total_price" name="total_price" value="700" readonly>
                </div>


                <button type="submit" class="btn btn-success">Set Appointment</button>
                <a href="#" onclick="history.back();" class="btn btn-danger ml-2">Cancel</a>
            </form>
        </div>
    </div>
</div>

<br><br>

  <!-- Footer -->
  <footer class="footer bg-dark text-white text-center py-3">
    <div class="container">
      <span>&copy; 2024 - HealthCare Xpress</span>
    </div>
  </footer>



</body>
</html>
