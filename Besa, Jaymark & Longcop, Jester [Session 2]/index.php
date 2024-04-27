<!DOCTYPE html>
<html>
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Session 2</title>
      <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
   </head>
   
   <?php
// Replace 'your_database_connection_info' with your actual database connection information
$servername = "localhost"; // Change this to your MySQL server address
$username = "root"; // Change this to your MySQL username
$password = ""; // Change this to your MySQL password if you have one, otherwise leave it empty
$database = "Session2";

// Create connection
$connection = new mysqli($servername, $username, $password, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Query to check if the user exists in the employees table and select the 'IsAdmin' column
    $query = "SELECT *, IsAdmin FROM employees WHERE Username='$username' AND Password='$password'";
    $result = $connection->query($query);
    
    if ($result->num_rows == 1) {
        // If a row exists in the result set, the user is considered authenticated
        $row = $result->fetch_assoc();
        
        // Check if the 'IsAdmin' column indicates the user is an admin
        $isAdmin = $row['IsAdmin'];
        
        if ($isAdmin == 1) {
            // If the user is an admin, display an alert message
            echo "<script>alert('Admin login successful');</script>";
            header("Location: reqManagement.php");
            exit;
        } else {
            // If the user is not an admin, display an alert message
            echo "<script>alert('User login successful');</script>";
            header("Location: assetlist.php");
            exit;
        }
    } else {
        // Username or password is incorrect
        echo "<script>alert('Invalid username or password');</script>";
    }
}
?>

<body>
    <div class="container">
        <div class="inside-container">
            <h2>Sign in to EM Management</h2>
            <form method="post" action="">
                <label for="username">Username</label>
                <input type="text" name="username" id="username">
                <label for="password">Password</label>
                <input type="password" name="password" id="password">
                <div class="button-container">
                    <button type="submit">Sign In</button>
                    <button type="reset">Clear</button>
                </div>
            </form>
        </div>
    </div>
</body>

</script>
</body>
</html>