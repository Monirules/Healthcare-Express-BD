<?php
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Retrieve form data
    $name = $_POST['name'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $room_no = $_POST['room_no'];
    $schedule = $_POST['schedule'];
    $schedule2 = $_POST['schedule2'];
    $email = $_POST['email'];
    $user_password = $_POST['password']; 

    // Check if an image file is uploaded
    if ($_FILES["image"]["error"] == 0) {
        $targetDirectory = "uploads/"; // Directory for storing uploaded images
        $targetFile = $targetDirectory . basename($_FILES["image"]["name"]);
        
        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            // File uploaded successfully
            $imagePath = $targetFile;
        } else {
            echo "Failed to upload image.";
        }
    }

    // Create connection
    $servername = "localhost";
    $username = "root";
    $db_password = ""; 
    $database = "healthcare_xpress"; 
    $mysqli = new mysqli($servername, $username, $db_password, $database);

    // Check connection
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }
    
    // Insert doctor data
    $query = "INSERT INTO doctor (name, description, category, room_no, schedule, schedule2, email, password, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("sssssssss", $name, $description, $category, $room_no, $schedule, $schedule2, $email, $user_password, $imagePath); 
    $stmt->execute();


    
    
    // Redirect to manage doctors page
    header("Location: manage_doctors.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Doctor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0sIHeX5vGm/QyQxAW3rpkkfYV/5cOyKRJzpxr0z21OaiFKv09BYhLT5eQsNOF" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Add Doctor</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
        <input type="file" name="image" id="image">    
        
        <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <input type="text" class="form-control" id="description" name="description" required>
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <input type="text" class="form-control" id="category" name="category" required>
            </div>
            <div class="mb-3">
                <label for="room_no" class="form-label">Room Number</label>
                <input type="text" class="form-control" id="room_no" name="room_no" required>
            </div>
            <div class="mb-3">
                <label for="schedule" class="form-label">Schedule</label>
                <input type="text" class="form-control" id="schedule" name="schedule" required>
            </div>
            <div class="mb-3">
                <label for="schedule2" class="form-label">Second Schedule</label>
                <input type="text" class="form-control" id="schedule2" name="schedule2" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" name="submit" class="btn btn-success">Submit</button>
            <a href="manage_doctors.php" class="btn btn-danger btn-md ml-2">Cancel</a>
        </form>
    </div>
    <br><br>
    
</body>
</html>
