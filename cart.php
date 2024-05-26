<?php
error_reporting(E_ERROR | E_PARSE);
error_reporting(E_ALL);
// Start the session
session_start();


// Initialize user's cart if it doesn't exist
if (isset($_SESSION['id'])) {
    // Retrieve the user ID from the session
    $id = $_SESSION['id'];
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }
}

// Function to remove item from cart
function removeItem($index) {
    unset($_SESSION['cart'][$index]);
}

// Function to update quantity of item in cart
function updateQuantity($index, $quantity) {
    $_SESSION['cart'][$index]['quantity'] = $quantity;
    $_SESSION['cart'][$index]['total_price'] = $_SESSION['cart'][$index]['price'] * $quantity;
}

// Check if remove request is made
if (isset($_GET['remove'])) {
    $index = $_GET['remove'];
    removeItem($index);
    header('Location: cart.php');
    exit();
}

// Check if update quantity request is made
if (isset($_GET['update'])) {
    $index = $_GET['update'];
    $quantity = $_GET['quantity'];
    updateQuantity($index, $quantity);
    header('Location: cart.php');
    exit();
}

// Check if the cart is empty before proceeding to payment
if (empty($_SESSION['cart'])) {
    
    echo "<h1 style='text-align:center; color: rgb(0, 105, 211); margin-top:10%;'>Your cart is empty!!!</h1>";
    echo "<h3 style='text-align:center; color:rgb(185, 53, 0) ;'>Buy any medicine</h3>";
    echo "<div style='text-align:center;'><button onclick='history.back()' class='btn btn-danger ml-2'>Go Back</button></div>";
    exit();
}

?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Cart</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

</head>
<body>


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
                <a class="nav-link dropdown-toggle" href="" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
    
    <br><br><br><br>



<div class="container mt-5">
    <h2>Your Cart</h2>
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <tr>
                        <th>Medicine Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Check if cart is not empty
                    if (!empty($_SESSION['cart'])) {
                        // Iterate over cart items and display them
                        foreach ($_SESSION['cart'] as $key => $cart_item) {
                            echo "<tr>";
                            echo "<td>{$cart_item['name']}</td>";
                            echo "<td>{$cart_item['description']}</td>";
                            echo "<td>{$cart_item['price']}</td>";
                            echo "<td>";
                            echo "<select class='form-control' onchange='updateQuantity($key, this.value)'>";
                            for ($i = 1; $i <= 10; $i++) {
                                echo "<option value='$i'";
                                if ($cart_item['quantity'] == $i) {
                                    echo " selected";
                                }
                                echo ">$i</option>";
                            }
                            echo "</select>";
                            echo "</td>";
                            echo "<td>{$cart_item['total_price']}</td>";
                            echo "<td><a href='?remove=$key' class='btn btn-danger'>Remove</a></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>Your cart is empty.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
            <a href="#" onclick="history.back();" class="btn btn-danger ml-2">Go Back</a>
            <a href="checkout.php" class="btn btn-success">Proceed to Checkout</a>
            
        </div>
    </div>
</div>

<script>
    // Function to update quantity of item in cart via AJAX
    function updateQuantity(index, quantity) {
        window.location.href = `cart.php?update=${index}&quantity=${quantity}`;
    }
</script>

</body>
</html>
