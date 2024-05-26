<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Doctor Schedule</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="styles.css">
  <style>
    .card{
      width: 20rem; /* Set a fixed width for the card */
      height: auto;
    }
    .card:hover {
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2); /* Add shadow effect */
    transition: 0.3s; /* Add transition for smoothness */
    
}
  </style>
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
          <a class="nav-link" href="home.php">Home</a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="profile.php">Profile</a>
          </li>
          <li class="nav-item dropdown active">
            <a class="nav-link dropdown-toggle" href="medicine.html" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Medicine
            </a>
            <!-- <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="Antibiotics.html">Antibiotics </a>
                <a class="dropdown-item" href="Antacids.html">Antacids </a>
                <a class="dropdown-item" href="Antipyretics.html">Antipyretics</a>
                <a class="dropdown-item" href="Antidiabetics.html">Antidiabetics</a>
                <a class="dropdown-item" href="Antidepressants.html">Antidepressants</a>
            </div> -->

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
          <a class="nav-link" href="emergency_ambulance.html">Emergency</a>
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


  <h2 style="margin-top: 8%; text-align: center;color:chocolate;">Our Doctors</h2><br>

<p style="width: 60%; margin: 0 auto;">In the dynamic landscape of healthcare in Bangladesh, several essential medicine categories play pivotal roles in managing various health conditions. Among these, antibiotics stand as stalwart defenders against bacterial infections, ensuring individuals can combat illnesses effectively. Meanwhile, antipyretics offer respite from fevers, alleviating discomfort and restoring vitality to those feeling under the weather.</p>


<div class="container mt-5">
  <input type="text" id="searchInput2" class="form-control mb-3" placeholder="Search for medicine names...">
  <div class="row" id="doctorResults">
      <!-- Medicine cards will be dynamically populated here -->
      
  </div>
</div>



<div class="container mt-5">
    <div class="row">
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

        // Select doctors whose category is "Cardiologist"
        $query = "SELECT * FROM doctor WHERE category = 'Dermatologist'";
        $result = $mysqli->query($query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>
                <div class="col-md-4">
                    <div class="card">
                        <img class="card-img-top mx-auto" src="img/random4.jpg" style="width: 180px; height: 21vh;" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['name']; ?></h5>
                            <p class="card-text"><?php echo $row['description']; ?><br>
                                Department: <?php echo $row['category']; ?></p>
                            <a href="doctor_appointment.php?doctor=<?php echo $row['doctor_id']; ?>" class="btn btn-secondary">Set Appointment</a>
                        </div>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "<p>No Cardiologist found.</p>";
        }
        ?>
    </div>
</div>

<br><br>



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

  <script>
    // Function to perform AJAX request for live search
    function liveSearch() {
        var searchValue = document.getElementById("searchInput2").value;
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("doctorResults").innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", "doctor_search.php?query=" + searchValue, true);
        xhttp.send();
    }

    // Attach liveSearch function to input event
    document.getElementById("searchInput2").addEventListener("input", function() {
        liveSearch();
    });
</script>


</body>
</html>
