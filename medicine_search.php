<?php
// Database connection parameters
$servername = "localhost"; // Change this if your MySQL server is hosted elsewhere
$username = "root"; // Default MySQL username
$password = ""; // Default MySQL password is empty
$database = "healthcare_xpress"; // Name of your database
$table = "medicine"; // Name of your table

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

// Check if the search query is empty
if (!empty($searchQuery)) {
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
            echo "<p class='card-text'>" . $row['description'] . "</p>";
            echo "<a href='medicine_buy.php?medicine=" . $row['id'] . "' class='btn btn-primary'>Buy Now</a>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
        }
    } else {
        echo "<p>No medicine found with that name.</p>";
    }
} else {
    // If the search query is empty, display a message
    echo "<p>Please enter a medicine name to search.</p>";
}




// Close database connection
$conn->close();
?>
