<?php
session_start();

$serverName = "localhost";
$user = "root";
$pass = "";
$databaseName = "godlovesme";

$conn = new mysqli($serverName, $user, $pass, $databaseName);

if ($conn->connect_error) {
    die("Connection Failed: ".$conn->connect_error);
}

if (isset($_POST['signin'])) {
    $Username = $_POST['Username'];
    $Password = $_POST['Password'];

    $sql = "SELECT * FROM register WHERE Username = '$Username' AND Password = '$Password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['user_id'] = $row['user_id']; // Store user_id in session
        header("Location: information.php");
        exit();
    } else {
        echo '<script>alert("Invalid username or password");</script>';
    }
}
?>
   
   <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="images/login.png" type="image/x-icon">
        <link rel="stylesheet" href="css/stylelogin.css">

        <title>Login Portal</title>
    </head>
    <body>

    <header>
        <img class="logo" src="images/datamex.jpg" alt="">
        <h1>Login Portal</h1>
    </header>

    <nav>
        <ul>
            <li><a href="homepage.php">Home</a></li>
        </ul>
    </nav>

    <main>
        <div class="login-container">
            <h2>Login</h2>
            <form action="login.php" method="post">
                <label for="Username">Username:</label><br>
                <input type="text" id="Username" name="Username" required><br>

                <label for="Password">Password:</label><br>
                <input type="Password" id="Password" name="Password" required><br><br>
                <input id="signinButton" name="signin" type="submit" value="Login">
                <p>Don't have an account? <a href="register.php">Register here</a>.</p>
            </form>
        </div>
    </main>

    <footer>
        <p>&copy; 2024 Simple Website. All rights reserved.</p>
    </footer>
    </body>
    </html>