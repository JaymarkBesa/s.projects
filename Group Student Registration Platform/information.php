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

    $check_sql = "SELECT * FROM tbinformation WHERE user_id = '$user_id'";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
        echo "Error: Information already exists for this user.";
    } else {
        $insert_sql = "INSERT INTO tbinformation (user_id, name, age, address, contact, birthday, gender, gmail, bloodtype) 
                VALUES ('$user_id', '$Name','$Age','$Address','$Contact','$Birthday','$Gender', '$Gmail', '$Bloodtype')";
        $insert_result = $conn->query($insert_sql);
        if ($insert_result === TRUE) {
        } else {
            echo "Error: " . $insert_sql . "<br>" . $conn->error;
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/student-card.png" type="image/x-icon">
    <link rel="stylesheet" href="css/styleinformation.css">

    <title>Student Lobby</title>
</head>
<body>

<header>
    <img class="logo" src="images/datamex.jpg" alt="">
    <h1>Student Profile</h1>
</header>

<nav>
    <ul>
        <li><a href="login.php">Logout</a></li>
    </ul>
</nav>

<body>
    
    <div class="holder">
    <div class="form">
    <form action="#" method="post" class="student-form">
    <h2>Student Information</h2>
    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
    </div>
    
    <div class="form-group">
        <label for="age">Age:</label>
        <input type="number" id="age" name="age" maxlength="2" required>
    </div>
    
    <div class="form-group">
        <label for="address">Address:</label>
        <textarea id="address" name="address" required></textarea>
    </div>
    
    <div class="form-group">
        <label for="contact">Contact:</label>
        <input type="tel" id="contact" name="contact" pattern="[0-9]{11}" placeholder="09XXXXXXXXX" maxlength="11" required>


    </div>
    
    <div class="form-group">
        <label for="birthday">Birthday:</label>
        <input type="date" id="birthday" name="birthday" required>
    </div>
    
    <div class="form-group">
        <label for="gender">Gender:</label>
        <select id="gender" name="gender" required>
            <option value="">Select</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select>
    </div>
    
    <div class="form-group">
        <label for="gmail">Gmail Address:</label>
        <input type="email" id="gmail" name="gmail" value="<?php if(isset($row['gmail'])) echo $row['gmail']; ?>" required pattern=".+@gmail\.com$" title="Please enter a valid Gmail address">

    </div>
    
    <div class="form-group">
        <label for="bloodtype">Blood Type:</label>
        <input type="text" id="bloodtype" name="bloodtype" required>
    </div>
    
    <div class="form-group">
        <input type="submit" name="submit" value="Submit">
    </div>
</form>
</div>

<div class="table-holder">
<?php 

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM tbinformation WHERE user_id = $user_id";
$result = $conn->query($sql); // Retrieve data from database using the query

?>
<div class="container">
        <h2>STUDENT LIST</h2>
<table class="table">
    <thead>
        <tr>
        <th>Name</th>
        <th>Age</th>
        <th>Address</th>
        <th>Contact</th>
        <th>Birthday</th>
        <th>Gender</th>
        <th>Gmail</th>
        <th>Bloodtype</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody> 

        <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
        ?>
                    <tr>    
                        <td><?php echo $row['Name']; ?></td>
                        <td><?php echo $row['Age']; ?></td>
                        <td><?php echo $row['Address']; ?></td>
                        <td><?php echo $row['Contact']; ?></td>
                        <td><?php echo $row['Birthday']; ?></td>
                        <td><?php echo $row['Gender']; ?></td>
                        <td><?php echo $row['Gmail']; ?></td>
                        <td><?php echo $row['Bloodtype']; ?></td>
                        <td>
                            <a class="btn btn-info" href="update.php?user_id=<?php echo $row['user_id']; ?>">Edit</a>&nbsp;
                            <a class="btn btn-danger" name="delete" href="delete.php?user_id=<?php echo $row['user_id']; ?>">Delete</a>

                        </td>
                    </tr>                        
        <?php       }
            }
        ?>                
    </tbody>
</table>

 <?php 
    // Closing the database connection after using $result
    $conn->close(); 
    ?>
</div>
</div>

</body>
</html>