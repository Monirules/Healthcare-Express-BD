

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HealthCare Xpress</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="styles.css">
  
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

<h2 style="color:rgb(196, 111, 0); text-align: center; margin-top: 2%;" class="mb-3">Live consult with doctors</h2> <hr><br>

<div class="container">
        <div class="row mt-3">
            <div class="col-md-12">
                <?php
                
                if (isset($_GET['category'])) {
                    // Retrieve the category from the URL
                    $category = $_GET['category'];

                    error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);

                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $database = "healthcare_xpress";

                    // Create connection
                    $mysqli = new mysqli($servername, $username, $password, $database);

                    // Example query
                    $sql = "SELECT * FROM live_consultant WHERE category = '$category'";
                    // Execute the query and fetch results
                    $result = mysqli_query($mysqli, $sql);

                    
                    
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            
                            echo "<div class='card'>";
                            echo "<div class='row no-gutters'>";
                            echo "<div class='col-md-2'>";
                            
                            echo "<img src='img/random3.jpg' class='card-img img-fluid' alt='Doctor Image' style='width: 180px; height: 200px; object-fit: cover;'>";
                            echo "</div>";
                            echo "<div class='col-md-10'>";
                            echo "<div class='card-header'><b>{$row['name']} </b></div>";
                            echo "<div class='card-body'>";
                            
                            echo "<p class='card-text'>{$row['description']}</p>";
                            echo "<p class='card-text'>Category: {$row['category']}</p>";
                            echo "<p class='card-text'>Meet Link: {$row['meet_link']}</p>";
                            echo "<p class='card-text'> Time: {$row['time']}</p>";
                            echo "<p class='card-text'> Price: {$row['price']}</p>";
                            
                            echo "<a href='consult_booking.php?consult_id={$row['consult_id']}' class='btn btn-primary'>Book Appointment</a>";

                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                        echo "<br>";
                    }
                    } else {
                        echo "No doctors found for this $category.";
                    }
                    
                    
                } else {
                    
                    echo "Error: Category parameter is missing.";
                
                }
                ?>
            </div>
        </div>
    </div>


<br><br>



  <!-- JavaScript and dependencies -->
  <script>
    // Function to handle Add to Cart button click
    document.querySelectorAll('.addToCartBtn').forEach(btn => {
        btn.addEventListener('click', function() {
            // Get the medicine ID from the data attribute
            const medicineId = this.getAttribute('data-medicine-id');
            // Check if the medicine is already in the cart
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            if (!cart.includes(medicineId)) {
                // Add the medicine to the cart
                cart.push(medicineId);
                // Save the updated cart to local storage
                localStorage.setItem('cart', JSON.stringify(cart));
                // Update the UI (e.g., change button text)
                this.textContent = 'Added to Cart';
                this.disabled = true; // Disable the button after adding to cart
            }
        });
    });
</script>


  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
