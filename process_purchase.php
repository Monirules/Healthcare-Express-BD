<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $medicine_id = $_POST["medicine_id"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $contact_no = $_POST["contact_no"];
    $address = $_POST["address"];
    $medicine_name = $_POST["medicine_name"];
    $medicine_description = $_POST["medicine_description"];
    $medicine_price = $_POST["medicine_price"];
    $quantity = $_POST["quantity"];
    $total_price = $_POST["total_price"];
    $payment_method = $_POST["payment_method"];
    $bkash_txn_number = isset($_POST["bkash_txn_number"]) ? $_POST["bkash_txn_number"] : "";

    // Insert data into the database
    $servername = "localhost";
    $username = "root"; // Replace with your MySQL username
    $password = ""; // Replace with your MySQL password
    $dbname = "healthcare_xpress";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL statement to insert data into the medicine_purchase table
    $sql = "INSERT INTO medicine_purchase (medicine_id, name, email, contact_no, address, medicine_name, medicine_description, medicine_price, quantity, total_price, payment_method, bkash_txn_number) 
            VALUES ('$medicine_id', '$name', '$email', '$contact_no', '$address', '$medicine_name', '$medicine_description', '$medicine_price', '$quantity', '$total_price', '$payment_method', '$bkash_txn_number')";

    if ($conn->query($sql) === TRUE) {
        echo "<div style='text-align: center; color: green; font-size: 25px; margin-top: 10%;'>Purchase details recorded successfully.</div>";
        echo "<div style='text-align: center; color: rgb(145, 72, 3); font-size: 25px; '>Redirecting in 3 seconds...</div>";
    } else {
        echo "<div style='text-align: center; color: red;'>Error: " . $sql . "<br>" . $conn->error . "</div>";
    }


    $conn->close();

    echo "<script>
        setTimeout(function() {
            window.location.href = 'medicine.html';
        }, 3000);
      </script>";

} else {
    // Redirect to the medicine page if the form is not submitted
    header("Location: medicine.html");
    exit();
}
?>
