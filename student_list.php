
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

$query = "SELECT * FROM students ORDER BY name ASC;";
$result = $conn->query($query);
?>



<html>
<head>
    <title>Student List</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
	<center>
	<h1>STUDENT RECORD</h1>
		<div class="contain">
			<h2>STUDENT LIST</h2>
			<table border="1">
				<tr>
					<th>Name</th>
					<th>Age</th>
					<th>Grade</th>
					<th>Actions</th>
				</tr>
				<?php while ($row = $result->fetch_assoc()): ?>
				<tr>
					<td><?php echo $row['name']; ?></td>
					<td><?php echo $row['age']; ?></td>
					<td><?php echo $row['grade']; ?></td>
					<td>
						<a href="student_edit.php?id=<?php echo $row['id']; ?>">Edit</a> |
						<a href="student_delete.php?id=<?php echo $row['id']; ?>">Delete</a>
					</td>
				</tr>
				<?php endwhile; ?>
			</table>
			<a href="home.php">Back to home</a>
		</div>
	</center>
</body>
</html>


