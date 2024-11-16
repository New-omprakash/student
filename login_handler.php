
<?php
session_start(); // Start the session at the beginning

$host = "localhost";
$dbname = "school";
$dbuser = "root";
$dbpass = "";

// Database connection
$conn = new mysqli($host, $dbuser, $dbpass, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get username and password from POST data
$username = $_POST['username'];
$password = $_POST['password'];

// Prepare the SQL statement
$query = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Check if user exists and password is correct
if ($user && password_verify($password, $user['password'])) {
    $_SESSION['username'] = $username;
    header("Location: home.php");
    exit();
} else {
    echo "Invalid credentials. <a href='login.php'>Try again</a>";
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
