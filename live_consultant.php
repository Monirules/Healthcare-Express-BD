

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

<div class="row" style="margin-left: 3%; margin-right: 3%;">
  <div class="col-sm-6">
    <div class="card">
        <h5 class="card-header">General Physician</h5>
      <div class="card-body">
        <p class="card-text">Cold, flu, fever, vomiting, infections, headaches or any other general health issues.</p>
        <a href="consult_list.php?category=general" class="btn btn-success">Search Doctors</a>
      </div>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="card">
        <h5 class="card-header">Gynae & obs</h5>
      <div class="card-body">
        <p class="card-text">Any women's health related issues including pregnancy, menstruation, fertility issues, hormone disorders etc.</p>
        <a href="consult_list.php?category=Gynae" class="btn btn-success">Search Doctors</a>
      </div>
    </div>
  </div>
</div>

<br><br>

<div class="row" style="margin-left: 3%; margin-right: 3%;">
    <div class="col-sm-6">
      <div class="card">
          <h5 class="card-header">Dermatology</h5>
        <div class="card-body">
          <p class="card-text">Treatment of diseases related to skin, hair and nails and some cosmetic problems.</p>
          <a href="consult_list.php?category=Dermatology" class="btn btn-success">Search Doctors</a>
        </div>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="card">
          <h5 class="card-header">Pediatrics</h5>
        <div class="card-body">
          <p class="card-text">Prevention, diagnosis, and treatment of adults across the spectrum from health to complex illness.</p>
          <a href="consult_list.php?category=Pediatrics" class="btn btn-success">Search Doctors</a>
        </div>
      </div>
    </div>
  </div>

  <br><br>

  <div class="row" style="margin-left: 3%; margin-right: 3%; ">
    <div class="col-sm-6">
      <div class="card">
          <h5 class="card-header">Psychology</h5>
        <div class="card-body">
          <p class="card-text"> Identify and diagnose mental, behavioral, and emotional disorders. </p>
          <a href="consult_list.php?category=Psychology" class="btn btn-success">Search Doctors</a>
        </div>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="card">
          <h5 class="card-header">Cardiology</h5>
        <div class="card-body">
          <p class="card-text"> Diagnosis, treatment of congenital heart defects, coronary artery disease, heart failure, and valvular heart disease.</p>
          <a href="consult_list.php?category=Cardiology" class="btn btn-success">Search Doctors</a>
        </div>
      </div>
    </div>
  </div>

<br><br><br><br>

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
