<?php
$servername = "localhost"; // Change this if your MySQL server is hosted elsewhere
$username = "root"; // Default MySQL username
$password = ""; // Default MySQL password is empty
$database = "healthcare_xpress"; // Name of your database

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['query2']) && !empty($_GET['query2'])) {
    $searchQuery2 = $_GET['query2'];
    
    // Prepare SQL statement to search for addresses not in emergency_submission
    $sql2 = "
        SELECT e.* 
        FROM emergency e
        LEFT JOIN emergency_submission es ON e.emergency_id = es.emergency_id
        WHERE e.address LIKE '%$searchQuery2%'
        AND es.emergency_id IS NULL";
    
    // Execute SQL query
    $result = $conn->query($sql2);

    if ($result->num_rows > 0) {
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<div class='col-md-4'>";
            echo "<div class='card'>";
            
            echo "<div class='card-body'>";
            echo "<h5 class='card-title'>" . $row['name'] . "</h5>";
            echo "<p class='card-text'> 0" . $row['phone'] . "</p>";
            echo "<p class='card-text'>" . $row['address'] . "</p>";
            echo "<p class='card-text'>Price - " . $row['price'] . "</p>";
            echo "<a href='submit_emergency.php' class='btn btn-primary'>Book Now</a>";
            echo "<td><button type='button' class='btn btn-success' style='margin-left:10px;' onclick=\"callAmbulance('{$row['phone']}')\">Call</button></td>";
          
            echo "</div>";
            echo "</div>";
            echo "</div>";
        }
    }

    // Check if any results were found
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row['address']}</td>";
            echo "<td>{$row['name']}</td>";
            echo "<td>0{$row['phone']}</td>";
            echo "<td><a href='tel:0{$row['phone']}' class='btn btn-success'>Call</a></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='4' class='text-center'>No ambulance found with that location.</td></tr>";
    }
} else {
    echo "<tr><td colspan='4' class='text-center'>Please enter your location to search.</td></tr>";
}

$conn->close();
?>
