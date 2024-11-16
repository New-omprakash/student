
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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $grade = $_POST['grade'];

    $query = "INSERT INTO students (name, age, grade) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sis", $name, $age, $grade);
    $stmt->execute();
    header("Location: home.php");
}
?>
<html>
<head>
    <title>Register Student</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<center>
<h1>REGISTER </h1>
	<div class="contain">
		<h2>STUDENT</h2>
		<form method="POST">
			<input type="text" name="name" placeholder="Name" required>
			<input type="number" name="age" placeholder="Age" required>
			<input type="text" name="grade" placeholder="Grade" required>
			<button type="submit">Register</button>
		</form>
	</div>
</center>
</body>
</html>
