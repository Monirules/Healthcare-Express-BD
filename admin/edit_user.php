<?php
// Assuming you have already established a database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "healthcare_xpress";

// Create connection
$mysqli = new mysqli($servername, $username, $password, $database);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Retrieve form data
    $id = $_POST['id'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Update user data
    $query = "UPDATE user SET name=?, phone=?, email=?, password=? WHERE id=?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("ssssi", $name, $phone, $email, $password, $id);
    $stmt->execute();
    
    // Redirect to manage users page
    header("Location: manage_user.php");
    exit();
} elseif ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    // Retrieve user details from database
    $id = $_GET['id'];
    $query = "SELECT * FROM user WHERE id=?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
} else {
    // Redirect to manage users page if no ID is provided
    header("Location: manage_user.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <!-- Add your CSS and Bootstrap links here -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit User</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $user['name']; ?>" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $user['phone']; ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $user['email']; ?>" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" value="<?php echo $user['password']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
            <a href="manage_user.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>
