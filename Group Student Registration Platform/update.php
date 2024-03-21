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

if (isset($_POST['submit'])) {
    $user_id = $_SESSION['user_id']; // Retrieve user_id from session
    $Name = $_POST['name'];
    $Age = $_POST['age'];
    $Address = $_POST['address'];
    $Contact = $_POST['contact'];
    $Birthday = $_POST['birthday'];
    $Gender = $_POST['gender'];
    $Gmail = $_POST['gmail'];
    $Bloodtype = $_POST['bloodtype'];

    $sql = "UPDATE `tbinformation` SET `name`='$Name',`age`='$Age',`address`='$Address',`contact`='$Contact', `birthday`='$Birthday', `gender`='$Gender', `gmail`='$Gmail', `bloodtype`='$Bloodtype' WHERE `user_id`='$user_id'"; 
    $result = $conn->query($sql); 
    if ($result === TRUE) {
        echo "Record updated successfully.";
        header("Location: information.php"); // Redirect to information page after successful update
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
    echo "User ID: " . $user_id; // Debug output
    $sql = "SELECT * FROM `tbinformation` WHERE `user_id`='$user_id'";
    $result = $conn->query($sql); 
    if ($result === FALSE) { 
        echo "Error: " . $sql . "<br>" . $conn->error; // Print any error
    } elseif ($result->num_rows > 0) {        
        $row = $result->fetch_assoc(); // Retrieve row from result
    } else { 
        header('Location: information.php'); // Redirect if no records found
        exit(); // Make sure to exit after redirection
    }      
}           
?>              

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/update.png" type="image/x-icon">
    <link rel="stylesheet" href="css/update.css">
    <title>Modify</title>
</head>
<body>

<header>
    <img class="logo" src="images/datamex.jpg" alt="">
    <h1>Login Portal</h1>
</header>

<nav>
    <ul>
        <li><a href="information.php">Back</a></li>
        <li><a href="login.php">Logout</a></li>
    </ul>
</nav>

<div class="form">
    <form action="#" method="post" class="student-form">
        <h2>Student Information</h2>
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php if(isset($row['name'])) echo $row['name']; ?>" required>
        </div>
        
        <div class="form-group">
            <label for="age">Age:</label>
            <input type="number" id="age" name="age" value="<?php if(isset($row['age'])) echo $row['age']; ?>" maxlength="2" required>
        </div>
        
        <div class="form-group">
            <label for="address">Address:</label>
            <textarea id="address" name="address" required><?php if(isset($row['address'])) echo $row['address']; ?></textarea>
        </div>
        
        <div class="form-group">
            <label for="contact">Contact:</label>
            <input type="tel" id="contact" name="contact" value="<?php echo isset($row['contact']) ? format_ph_contact($row['contact']) : ''; ?>" pattern="[0-9]{11}" placeholder="09XXXXXXXXX" maxlength="11" required>
        </div>
        
        <div class="form-group">
            <label for="birthday">Birthday:</label>
            <input type="date" id="birthday" name="birthday" value="<?php if(isset($row['birthday'])) echo $row['birthday']; ?>" required>
        </div>
        
        <div class="form-group">
            <label for="gender">Gender:</label>
            <select id="gender" name="gender" required>
                <option value="Male" <?php if(isset($row['gender']) && $row['gender'] == 'Male') echo 'selected'; ?>>Male</option>
                <option value="Female" <?php if(isset($row['gender']) && $row['gender'] == 'Female') echo 'selected'; ?>>Female</option>
            </select>
        </div>
        
        <div class="form-group">
            <label for="gmail">Gmail Address:</label>
            <input type="email" id="gmail" name="gmail" value="<?php if(isset($row['gmail'])) echo $row['gmail']; ?>" required pattern=".+@gmail\.com$" title="Please enter a valid Gmail address">

        </div>
        
        <div class="form-group">
            <label for="bloodtype">Blood Type:</label>
            <input type="text" id="bloodtype" name="bloodtype" value="<?php if(isset($row['bloodtype'])) echo $row['bloodtype']; ?>" required>
        </div>
        
        <div class="form-group">
            <input type="submit" name="submit" value="Submit">
        </div>
    </form>
</div>

<footer>
    <p>&copy; 2024 Simple Website. All rights reserved.</p>
</footer>

</body>
</html>
