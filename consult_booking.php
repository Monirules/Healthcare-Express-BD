<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Consultation</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <?php
            if (isset($_GET['consult_id'])) {
                // Retrieve the consult_id from the URL
                $consult_id = $_GET['consult_id'];

                error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);

                $servername = "localhost";
                $username = "root";
                $password = "";
                $database = "healthcare_xpress";

                // Create connection
                $mysqli = new mysqli($servername, $username, $password, $database);

                // Prepare statement to fetch doctor's information
                $stmt = $mysqli->prepare("SELECT * FROM live_consultant WHERE consult_id = ?");
                $stmt->bind_param("i", $consult_id);

                // Execute the query
                $stmt->execute();

                // Get result
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {

                        echo "<div class='card'>";
                        echo "<div class='row no-gutters'>";
                        echo "<div class='col-md-2'>";
                        echo "<img src='img/random3.jpg' class='card-img img-fluid' alt='Doctor Image' style='width: 180px; height: 200px; object-fit: cover;'>";
                        echo "</div>";
                        echo "<div class='col-md-10'>";
                        echo "<div class='card-header'><b>{$row['name']}</b></div>";
                        echo "<div class='card-body'>";
                        echo "<p class='card-text'>{$row['description']}</p>";
                        echo "<p class='card-text'>Category: {$row['category']}</p>";
                        echo "<p class='card-text'>Meet Link: {$row['meet_link']}</p>";
                        echo "<p class='card-text'>Time: {$row['time']}</p>";
                        echo "<p class='card-text'>Price: {$row['price']}</p>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                        echo "<br>";

                        // User form
                        echo "<form action='' method='post'>";
                        echo "<input type='hidden' name='consult_id' value='{$row['consult_id']}'>";
                        echo "<input type='hidden' name='doctor_name' value='{$row['name']}'>";
                        echo "<input type='hidden' name='category' value='{$row['category']}'>";
                        echo "<input type='hidden' name='meet_link' value='{$row['meet_link']}'>";
                        echo "<input type='hidden' name='time' value='{$row['time']}'>";
                        echo "<input type='hidden' name='price' value='{$row['price']}'>";
                        echo "<div class='form-group'>";
                        echo "<label for='name'>Name:</label>";
                        echo "<input type='text' class='form-control' id='name' name='name' required>";
                        echo "</div>";
                        echo "<div class='form-group'>";
                        echo "<label for='address'>Address:</label>";
                        echo "<input type='text' class='form-control' id='address' name='address' required>";
                        echo "</div>";
                        echo "<div class='form-group'>";
                        echo "<label for='email'>Email:</label>";
                        echo "<input type='email' class='form-control' id='email' name='email' required>";
                        echo "</div>";
                        echo "<div class='form-group'>";
                        echo "<label for='phone'>Phone:</label>";
                        echo "<input type='text' class='form-control' id='phone' name='phone' required>";
                        echo "</div>";
                        echo "<a href='#' onclick='history.back();' class='btn btn-danger ml-2'>Go Back</a>";
                        echo "<button style='margin-left: 15px;' type='submit' class='btn btn-success'>Book Appointment</button>";
                        echo "</form>";
                    }
                } else {
                    echo "No doctors found for this consult ID.";
                }

                // Handle form submission
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    // Retrieve user information
                    $name = $_POST['name'];
                    $address = $_POST['address'];
                    $email = $_POST['email'];
                    $phone = $_POST['phone'];
                    $consult_id = $_POST['consult_id'];
                    $doctor_name = $_POST['doctor_name'];
                    $category = $_POST['category'];
                    $meet_link = $_POST['meet_link'];
                    $time = $_POST['time'];
                    $price = $_POST['price'];

                    // Insert user and doctor information into 'book_consult' table
                    $sql = "INSERT INTO book_consult (name, address, email, phone, consult_id, doctor_name, category, meet_link, time, price) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                    $stmt = $mysqli->prepare($sql);
                    $stmt->bind_param("ssssisssss", $name, $address, $email, $phone, $consult_id, $doctor_name, $category, $meet_link, $time, $price);
                    if ($stmt->execute()) {
                        echo "<div class='alert alert-success mt-3' role='alert'>Appointment booked successfully!</div>";
                    } else {
                        echo "<div class='alert alert-danger mt-3' role='alert'>Error booking appointment. Please try again.</div>";
                    }
                }

                // Close statement and connection
                $stmt->close();
                $mysqli->close();
            } else {
                echo "Error: consult_id parameter is missing.";
            }
            ?>
        </div>
    </div>
</div>

</body>
</html>
