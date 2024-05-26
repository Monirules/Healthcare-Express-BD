<?php
error_reporting(E_ERROR | E_PARSE);
error_reporting(E_ALL ^ E_WARNING);
session_start();

// Check if medicine ID is provided in the URL
if (isset($_GET['medicine']) && is_numeric($_GET['medicine'])) {
    // Medicine ID retrieved from URL
    $medicine_id = $_GET['medicine'];

    // Database connection parameters
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "healthcare_xpress";
    $table = "medicine";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL statement to fetch medicine details
    $sql = "SELECT * FROM $table WHERE id = $medicine_id";

    // Execute SQL query
    $result = $conn->query($sql);

    // Check if medicine details are found
//     if ($result->num_rows > 0) {
//         // Medicine details fetched successfully
//         $medicine = $result->fetch_assoc();
//     } else {
//         // No medicine found with the provided ID
//         echo "<p>No medicine found with the provided ID.</p>";
//         exit; // Stop further execution
//     }

//     // Close database connection
//     $conn->close();
// } else {
//     // Medicine ID is missing or invalid
//     echo "<p>Invalid medicine ID.</p>";
//     exit; // Stop further execution
// }



    // Check if medicine details are found
    if ($result->num_rows > 0) {
        // Medicine details fetched successfully
        $medicine = $result->fetch_assoc();

        // Add medicine to cart
        $cart_item = array(
            'id' => $medicine['id'],
            'name' => $medicine['name'],
            'description' => $medicine['description'],
            'price' => $medicine['price'],
            'quantity' => 1, // Default quantity is 1
            'total_price' => $medicine['price'] // Initial total price is same as price
        );

        // Check if cart session variable exists, if not, create it
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }

        // Check if the medicine already exists in the cart, if yes, update its quantity and total price
        $existing_key = array_search($medicine_id, array_column($_SESSION['cart'], 'id'));
        if ($existing_key !== false) {
            $_SESSION['cart'][$existing_key]['quantity']++;
            $_SESSION['cart'][$existing_key]['total_price'] = $_SESSION['cart'][$existing_key]['quantity'] * $_SESSION['cart'][$existing_key]['price'];
        } else {
            // If medicine not already in cart, add it
            $_SESSION['cart'][] = $cart_item;
        }

        // Redirect to cart.php to view cart
        header("Location: cart.php");
        exit;
    } else {
        // No medicine found with the provided ID
        echo "<p>No medicine found with the provided ID.</p>";
        exit; // Stop further execution
    }

    // Close database connection
    $conn->close();
} else {
    // Medicine ID is missing or invalid
    echo "<p>Invalid medicine ID.</p>";
    exit; // Stop further execution
}
?>
// --------------------------------








<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicine Buy</title>
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
        
        <li class="nav-item active">
          <a class="nav-link" href="general.html">Appointments</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="emergency_ambulance.php">Emergency</a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="index.html">Logout</a>
          </li>
      </ul>
    </div>
  </nav>
  <br><br>

    <h2 style="margin-top: 4%; text-align: center;color:chocolate;">Medicine Buy Form</h2>
    
    <div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="process_purchase.php" method="post">
                <input type="hidden" name="medicine_id" value="<?php echo $medicine['id']; ?>">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
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
                    <label for="medicine_name">Medicine Name:</label>
                    <input type="text" class="form-control" id="medicine_name" name="medicine_name" value="<?php echo $medicine['name']; ?>" readonly>
                </div>

                <div class="form-group">
                    <label for="medicine_description">Medicine Description:</label>
                    <input type="text" class="form-control" id="medicine_description" name="medicine_description" value="<?php echo $medicine['description']; ?>" readonly>
                </div>

                <div class="form-group">
                    <label for="medicine_description">Price per medicine:</label>
                    <input type="text" class="form-control" id="medicine_price" name="medicine_price" value="<?php echo $medicine['price']; ?>" readonly>
                </div>

                <div class="form-group">
                    <label for="quantity">Quantity:</label>
                    <input type="number" class="form-control" id="quantity" name="quantity" min="1" required>
                </div>
                <div class="form-group">
                    <label for="total_price">Total Price:</label>
                    <input type="text" class="form-control" id="total_price" name="total_price" readonly>
                </div>


                <div class="form-group">
                    <label for="payment_method">Payment Method:</label>
                    <select class="form-control" id="payment_method" name="payment_method" required>
                        <option value="Cash on Delivery">Cash on Delivery</option>
                        <option value="Bkash Payment">Bkash Payment</option>
                    </select>
                </div>
                <div id="bkash_transaction_number" class="form-group" style="display: none;">
                bKash Send Money - <b>0176***2631 </b><br>
                
                    <label for="bkash_txn_number">Bkash Transaction Number:</label>
                    <input type="text" class="form-control" id="bkash_txn_number" name="bkash_txn_number">
                </div>

                <button type="submit" class="btn btn-success">Buy Now</button>
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

<script>
    // Function to show or hide the Bkash transaction number input field
    function toggleBkashTransactionInput() {
        var paymentMethod = document.getElementById("payment_method").value;
        var bkashTransactionInput = document.getElementById("bkash_transaction_number");

        if (paymentMethod === "Bkash Payment") {
            // Show the Bkash transaction number input field
            bkashTransactionInput.style.display = "block";
        } else {
            // Hide the Bkash transaction number input field
            bkashTransactionInput.style.display = "none";
        }
    }

    // Attach the toggleBkashTransactionInput function to the change event of the payment method select element
    document.getElementById("payment_method").addEventListener("change", toggleBkashTransactionInput);

    // Call the function initially to set the initial state of the Bkash transaction number input field
    toggleBkashTransactionInput();
</script>

<script>
    // Function to calculate the total price based on the quantity and price per medicine
    function calculateTotalPrice() {
        var quantity = parseInt(document.getElementById("quantity").value);
        var pricePerMedicine = parseFloat(document.getElementById("medicine_price").value);
        var totalPrice = quantity * pricePerMedicine;

        // Set the total price in the total_price input field
        document.getElementById("total_price").value = totalPrice.toFixed(2); // Rounded to 2 decimal places
    }

    // Attach the calculateTotalPrice function to the input event of the quantity input field
    document.getElementById("quantity").addEventListener("input", calculateTotalPrice);

    // Call the calculateTotalPrice function initially to set the initial total price
    calculateTotalPrice();
</script>


</body>
</html>
