<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['query'])) {
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

    $searchText = $mysqli->real_escape_string($_POST['query']);
    $sql = "SELECT * FROM emergency WHERE address LIKE '%$searchText%'";
    $result = mysqli_query($mysqli, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>{$row['address']}</td>";
            echo "<td>{$row['name']}</td>";
            echo "<td>{$row['phone']}</td>";
            echo "<td><button type='button' class='btn btn-danger'>Select</button></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='4'>No Ambulance Available</td></tr>";
    }

    $mysqli->close();
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Emergency Ambulance</title>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="styles.css">
  <style>
    .footer {
        /* position: absolute; */
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
    <h1 style="color:cadetblue; text-align: center;" class="mb-5">Perfect Team to Give Best service</h1><br><br>
   <div class="row">
       <div class="col-md-4">
           <div class="imgAbt">
               <img width="320px" height="230px" src="img/ambulance1.jpg" /> <br> <br>
               <img width="320px" height="240px" src="img/AmbulanceBD24-Team.png" />
           </div>
       </div>
       <div class="col-md-8">
           <p style="text-align:justify ; font-family: Perpetua; font-size: 20px;">
            “The gift of life is the biggest gift one could give to the others”. We proudly announce that we are one of the trustworthy emergency ambulance service providers in Dhaka, Bangladesh. We hold records when we catered to the emergency needs of people at the most crucial times. We are not only perfect with our name, the emergency ambulance service that we provide are specialized and prompt for years. We provide Ac Ambulance Service, ICU Ambulance Service, and Air Ambulance Service in Dhaka & All Over Bangladesh.
            <br><br>
            Our specialty is moving seriously ill patients through our best ambulance service in Dhaka, Bangladesh. We serve ambulance services to patients across all the hospitals of Dhaka in Bangladesh. Our ambulance services are arranged in the most organized manner. The ABC ambulance service provider in Dhaka, Bangladesh relocates the patients through emergency vehicles like AC ambulances, online ambulances, freezer ambulances that are well equipped with life support systems, or ICU setups. After serving in the capital for several years gracefully, our ambulance services are recognized as a leader for providing emergency healthcare.

            We noticed the adverse situation during the COVID-19 pandemic. The patients died before they were relocated to the hospitals. Witnessing the situation and keeping in the mind the value of life we launched online ambulance services in Dhaka. This will enable more and more to easily access our ambulance bd services at a crucial time. 
          </p>
       </div>
   </div>
<br><br>
   <h2 style="color:rgb(185, 22, 0); text-align: center;" class="mb-5">Search Ambulance</h2>
   
   <div class="container mt-5">
        <input type="text" id="searchInput2" class="form-control mb-3" placeholder="Search your location...">
        <div class="row" id="medicineResults2">
            <!-- Medicine cards will be dynamically populated here -->
            
        </div>

  </div>

</div>
<br><br><br>


<footer class="footer bg-dark text-white text-center py-3">
  <div class="container">
    <span>&copy; 2024 - HealthCare Xpress</span>
  </div>
</footer>




  <!-- Footer -->


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
                  document.getElementById("medicineResults2").innerHTML = this.responseText;
              }
          };
          xhttp.open("GET", "ambulance_search.php?query2=" + searchValue, true);
          xhttp.send();
      }

      // Attach liveSearch function to input event
      document.getElementById("searchInput2").addEventListener("input", function() {
          liveSearch();
      });
  </script>

  <script>
    function callAmbulance(phoneNumber) {
  // Use the tel protocol to initiate a call
  window.location.href = 'tel:' + phoneNumber;
}
</script>

</body>
</html>
