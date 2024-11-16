<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>


<html>
<head>
    <title>Home</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<center>
	<h1>WELCOME, <?php echo $_SESSION['username']; ?></h1>
	<div class="containers">
		<h2>DETAILS</h2>
		<nav>
			<a href="student_register.php"><button class="red">REGISTER STUDENT</button></a> <br><br>
			<a href="student_list.php"><button class="red">STUDENT LIST</button></a> <br><br>
			<a href="logout.php"><button class="red">Logout</button></a>
		</nav>
	</div>
</center>
</body>
</html>
