<?php
// Database connection parameters
$servername = "localhost"; // Change this if your MySQL server is hosted elsewhere
$username = "root"; // Default MySQL username
$password = ""; // Default MySQL password is empty
$database = "healthcare_xpress"; // Name of your database
$table = "doctor"; // Name of your table

// Create connection
$conn = new mysqli($servername, $username, $password,  $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch the search query from the AJAX request
$searchQuery = $_GET['query'];

// Prepare SQL statement to search for medicine names
$sql = "SELECT * FROM $table WHERE name LIKE '%$searchQuery%'";

// Execute SQL query
$result = $conn->query($sql);

// Check if any results were found
if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<div class='col-md-4'>";
        echo "<div class='card'>";
        
        echo "<div class='card-body'>";
        echo "<h5 class='card-title'>" . $row['name'] . "</h5>";
        echo "<p class='card-text'>" . $row['category'] . "</p>";
        echo "<p class='card-text'>" . $row['description'] . "</p>";
        echo "<p class='card-text'>" . $row['schedule'] . "</p>";
        echo "<a href='doctor_appointment.php?doctor=" . $row['doctor_id'] . "' class='btn btn-primary'>Set Appointment</a>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
    }
} else {
    echo "<p>No Doctor found with that name.</p>";
}

// Close database connection
$conn->close();
?>
