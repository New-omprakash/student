<!-- login.php -->
<?php
session_start();
if (isset($_SESSION['username'])) {
    header("Location: home.php");
    exit();
}
?>

<
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <center>
        <br><br>
        <h1>TEACHERS LOGIN</h1>
        <div class="container">
            <h2>LOGIN</h2>
            <form method="POST" action="login_handler.php">
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit">Login</button>
            </form><br><br>
            <p>Don't have an account? <a href="register.php">SIGN UP</a></p>
        </div>
    </center>
</body>
</html>
