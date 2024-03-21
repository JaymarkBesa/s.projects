<?php
$serverName = "localhost";
$user = "root";
$pass = "";
$databaseName = "godlovesme";

$conn = new mysqli($serverName, $user, $pass, $databaseName);

if ($conn->connect_error) {
    die("Connection Failed: ".$conn->connect_error);
}
?>

<?php 
if (isset($_POST['submit'])) {
    $Username = $_POST['Username'];
    $Password = $_POST['Password'];

    // Check if the username already exists
    $check_sql = "SELECT * FROM `register` WHERE `Username` = '$Username'";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
        echo '<script>alert("Username already exists. Please choose a different username.");</script>';
    } else {
        // Insert the new user into the database
        $sql = "INSERT INTO `register`(`Username`, `Password`) VALUES ('$Username','$Password')";
        $result = $conn->query($sql);
        if ($result === TRUE) {
            header("Location: login.php"); // Redirect the user to login.php
            echo "<script>alert('You have registered an account successfully.');</script>";
            exit();
        } else {
            echo "Error:". $sql . "<br>". $conn->error;
        } 
    }
    $conn->close();
}
?>


<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="images/register.png" type="image/x-icon">
        <link rel="stylesheet" href="css/styleregister.css">

        <title>Register</title>
    </head>
    <body>

    <header>
        <img class="logo" src="images/datamex.jpg" alt="">
        <h1>Register</h1>
    </header>

    <nav>
        <ul>
            <li><a href="homepage.php">Home</a></li>
        </ul>
    </nav>

    <main>
        <div class="register-container">
            <h2>Register</h2>
            <form action="" method="POST">
                <label for="Username">Username:</label><br>
                <input type="text" id="Username" name="Username" required><br>

                <label for="Password">Password:</label><br>
                <input type="Password" id="Password" name="Password" required><br><br>
                <input id="registerButton" name="submit" type="submit" value="Register">
                <p>Have an account? <a href="login.php">Click here</a>.</p>
            </form>
        </div>
    </main>

    <footer>
        <p>&copy; 2024 Simple Website. All rights reserved.</p>
    </footer>
    </body>
    </html>