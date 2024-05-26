<?php

session_start();

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    // Insert purchase information into the database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "healthcare_xpress";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL statement to insert purchase information
    $stmt = $conn->prepare("INSERT INTO medicine_purchase (name, address, contact_no, email, medicine_name, medicine_description, medicine_price, quantity, total_price, payment_method, bkash_txn_number) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Bind parameters
    $stmt->bind_param("ssssssdidds", $name, $address, $phone, $email, $medicineName, $medicineDescription, $medicinePrice, $quantity, $totalPrice, $paymentMethod, $bkashTxnNumber);

    // Insert each medicine from the cart into the database
    foreach ($_SESSION['cart'] as $cart_item) {
        $medicineName = $cart_item['name'];
        $medicineDescription = $cart_item['description'];
        $medicinePrice = $cart_item['price'];
        $quantity = $cart_item['quantity'];
        $totalPrice = $cart_item['total_price'];
        $paymentMethod = $_POST['payment_method']; // Assuming payment method is selected from the form
        $bkashTxnNumber = $_POST['bkash_txn_number']; // Assuming bKash transaction number is entered from the form

        // Execute the prepared statement
        $stmt->execute();
    }

    // Close statement and database connection
    $stmt->close();
    $conn->close();

    // Clear the cart after successful purchase
    unset($_SESSION['cart']);

    header("Location: home.php");
    exit;
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
              <a class="nav-link" href="emergency_ambulance.html">Emergency</a>
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
    <h2>Checkout</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <input type="hidden" name="medicine_id" value="<?php echo $medicine['id']; ?>">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="address">Address:</label>
            <input type="text" class="form-control" id="address" name="address" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone:</label>
            <input type="text" class="form-control" id="phone" name="phone" required>
        </div>
        <div class="form-group">
            <label for="phone">Email:</label>
            <input type="text" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
                    <label for="payment_method">Payment Method:</label>
                    <select class="form-control" id="payment_method" name="payment_method" required>
                        <option value="1">Cash on Delivery</option>
                        <option value="2">Bkash Payment</option>
                    </select>
                </div>
                <div id="bkash_transaction_number" class="form-group" style="display: none;">
                bKash Send Money - <b>0176***2631 </b><br>
                
                    <label for="bkash_txn_number">Bkash Transaction Number:</label>
                    <input type="text" class="form-control" id="bkash_txn_number" name="bkash_txn_number">
                </div>

        <h3>Selected Medicines:</h3>
        <table class="table">
            <thead>
            <tr>
                <th>Medicine Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total Price</th>
            </tr>
            </thead>
            <tbody>
            <?php
            // Check if cart is not empty
            if (!empty($_SESSION['cart'])) {
                // Iterate over cart items and display them
                foreach ($_SESSION['cart'] as $cart_item) {
                    echo "<tr>";
                    echo "<td>{$cart_item['name']}</td>";
                    echo "<td>{$cart_item['description']}</td>";
                    echo "<td>{$cart_item['price']}</td>";
                    echo "<td>{$cart_item['quantity']}</td>";
                    echo "<td>{$cart_item['total_price']}</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Your cart is empty.</td></tr>";
            }
            ?>
            </tbody>
        </table>

        <a href="#" onclick="history.back();" class="btn btn-danger ml-2">Go Back</a>
        <button type="submit" class="btn btn-success">Submit</button>
        
    </form>
</div>

<br><br><br><br><br>

<script>
    // Function to show or hide the Bkash transaction number input field
    function toggleBkashTransactionInput() {
        var paymentMethod = document.getElementById("payment_method").value;
        var bkashTransactionInput = document.getElementById("bkash_transaction_number");

        if (paymentMethod === "2") {
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
