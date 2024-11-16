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

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the student details
    $query = "SELECT * FROM students WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $student = $result->fetch_assoc();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $age = $_POST['age'];
        $grade = $_POST['grade'];

        // Update the student record
        $updateQuery = "UPDATE students SET name = ?, age = ?, grade = ? WHERE id = ?";
        $updateStmt = $conn->prepare($updateQuery);
        $updateStmt->bind_param("sisi", $name, $age, $grade, $id);

        if ($updateStmt->execute()) {
            header("Location: student_list.php");
            exit();
        } else {
            echo "Error updating student: " . $conn->error;
        }
    }
} else {
    header("Location: student_list.php");
    exit();
}
?>

<html>
<head>
    <title>Edit Student</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<center>
<h1>EDIT STUDENT </h1>
<div class="contain">
    <h2>STUDENT DETAILS</h2>
    <form method="POST">
        <input type="text" name="name" value="<?php echo htmlspecialchars($student['name']); ?>" required>
        <input type="number" name="age" value="<?php echo htmlspecialchars($student['age']); ?>" required>
<input type="text" name="grade" value="<?php echo htmlspecialchars($student['grade']); ?>" required>
        <button type="submit">Update Student</button>
    </form>
    <a href="student_list.php">Back to Student List</a>
</div>
</center>
</body>
</html>

