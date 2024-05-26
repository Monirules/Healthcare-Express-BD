<?php

session_start();
if($_SESSION["status"] != true){
  header ("location:index.php");
}
?>



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


  <!-- Slider -->
  <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel" data-interval="2200" style="margin-top: 4%;">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img class="d-block w-90 mx-auto" src="img/cover3.png" style="height: 80vh;" alt="First slide">
      </div>
      <div class="carousel-item">
        <img class="d-block w-90 mx-auto" src="img/cover2.png" style="height: 80vh;" alt="Second slide">
      </div>
      <div class="carousel-item">
        <img class="d-block w-90 mx-auto" src="img/cover1.png" style="height: 80vh;" alt="Third slide">
      </div>
    </div>
  </div>

  <!-- Feature buttons -->
  <div class="container">
    <div class="row mt-4">
      <div class="col-md-4 mb-3">
        <a href="Antibiotics.html" style="text-decoration: none;"><button class="btn btn-primary btn-lg btn-block">Buy Medicine</button></a>
      </div>
      <div class="col-md-4 mb-3">
        <a href="general.php" style="text-decoration: none;"><button class="btn btn-success btn-lg btn-block">Book Appointment</button></a>
      </div>
      <div class="col-md-4 mb-3">
        <a href="emergency_ambulance.html" style="text-decoration: none;"><button class="btn btn-danger btn-lg btn-block">Emergency</button></a>
      </div>
    </div>
  </div>

<p style="padding-left: 10%; padding-right: 10%; text-align: justify; margin-top: 2%; margin-bottom: 4%; font-family: Perpetua; font-size: 24px;">
    In an era where time constraints often impede individuals from prioritizing their health needs, especially in regions with limited access to 24/7 pharmacies such as Bangladesh, the importance of innovative healthcare solutions becomes increasingly evident. The HealthCare Xpress System seeks to bridge this gap by offering a comprehensive platform for convenient medical assistance. This system facilitates medication procurement through a simple process of uploading a prescription image, ensuring swift delivery to the users' doorstep. Moreover, in critical situations, the application provides emergency response functionalities, including notifying the nearby hospitals and doctor appointment scheduling. HealthCare Xpress System prioritizes user security through robust authentication measures and offers seamless account management features. Utilizing html and css for backend development and php for frontend design, the website ensures accessibility across all devices. With a clear guide, HealthCare Xpress System aims to sustainably serve the community while adapting to evolving user needs.
</p>

  <!-- Footer -->
  <footer class="footer bg-dark text-white text-center py-3">
    <div class="container">
      <span>&copy; 2024 - HealthCare Xpress</span>
    </div>
  </footer>

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
