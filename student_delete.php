
<?php
session_start();
$host = "localhost";
$dbname = "school";
$dbuser = "root";
$dbpass = "";

// Database connection
$conn = new mysqli($host, $dbuser, $dbpass, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the user is logged in; if not, redirect to login page
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Check if the student ID is provided in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the student record to display the confirmation details
    $query = "SELECT * FROM students WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $student = $result->fetch_assoc();

    if (!$student) {
        echo "Student not found.";
        exit();
    }

    // If the delete is confirmed, process the deletion
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['confirm_delete'])) {
        $deleteQuery = "DELETE FROM students WHERE id = ?";
        $deleteStmt = $conn->prepare($deleteQuery);
        $deleteStmt->bind_param("i", $id);

        if ($deleteStmt->execute()) {
            header("Location: student_list.php");
            exit();
        } else {
            echo "Error deleting student: " . $conn->error;
        }
    }
} else {
    header("Location: student_list.php");
    exit();
}
?>

<html>
<head>
    <title>Delete Student</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<center>
<h1>DELETE STUDENT</h1>
<div class="contain">
    <h2> STUDENT DETAILS</h2>
    <p>Are you sure you want to delete this student?</p>
    <p><strong>Name:</strong> <?php echo htmlspecialchars($student['name']); ?></p>
    <p><strong>Age:</strong> <?php echo htmlspecialchars($student['age']); ?></p>
    <p><strong>Grade:</strong> <?php echo htmlspecialchars($student['grade']); ?></p>

    <form method="POST">
        <button type="submit" name="confirm_delete">Yes, Delete</button>
        <a href="student_list.php" style="text-decoration: none; padding: 10px; background-color: #f4f4f9; border: 1px solid #ddd; border-radius: 5px;">Cancel</a>
    </form>
</div>
</center>
</body>
</html>

