<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $doctor_id = $_POST["doctor_id"];
    $name = $_POST["name"];
    $contact_no = $_POST["contact_no"];
    $address = $_POST["address"];
    $doctor_name = $_POST["doctor_name"];
    $category = $_POST["category"];
    $doctor_description = $_POST["doctor_description"];
    $schedule = $_POST["schedule"];
    $total_price = $_POST["total_price"];
   
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
    $sql = "INSERT INTO `doctor_appointment`(`doctor_id`, `name`, `contact_no`, `address`, `doctor_name`, `category`, `doctor_description`, `schedule`, `total_price`) 

    VALUES ('$doctor_id', '$name', '$contact_no', '$address', '$doctor_name', '$category', '$doctor_description', '$schedule', '$total_price')";


    if ($conn->query($sql) === TRUE) {
        echo "<div style='text-align: center; color: green; font-size: 35px; margin-top: 10%;'>Purchase details recorded successfully.</div>";
        echo "<div style='text-align: center; color: rgb(145, 72, 3); font-size: 25px; '>Redirecting in 3 seconds...</div>";
    } else {
        echo "<div style='text-align: center; color: red;'>Error: " . $sql . "<br>" . $conn->error . "</div>";
    }


    $conn->close();

    echo "<script>
        setTimeout(function() {
            window.location.href = 'general.html';
        }, 3000);
      </script>";

} else {
    // Redirect to the medicine page if the form is not submitted
    header("Location: general.html");
    exit();
}
?>
