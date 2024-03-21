<?php
$serverName = "localhost";
$user = "root";
$pass = "";
$databaseName = "studentinfo";
$conn =  new mysqli($serverName, $user, $pass, $databaseName);

if ($conn->connect_error) {
    die("Connection Failed: ".$conn->connect_error);
}

echo "Connection Established!";
?>

<?php
if (isset($_POST['submit'])) {
        $Name = $_POST['Name'];
        $Age = $_POST['Age'];
        $Address = $_POST['Address'];
        $ContactNumber = $_POST['ContactNumber'];
        $Birthdate = $_POST['Birthdate'];
        $Gender = $_POST['Gender'];
        $Bloodtype = $_POST['Bloodtype'];

$sql = "INSERT INTO `studentlist` (`Name`, `Age`, `Address`, `ContactNumber`, `Birthdate`, `Gender`, `Bloodtype`) values ('$Name', '$Age', '$Address', '$ContactNumber', '$Birthdate', '$Gender', '$Bloodtype')";
$result = $conn->query($sql);
if ($result == TRUE) {
    echo "New record created successfully.";
} else {
    echo "Error: ". $sql . "<br>". $conn->error;
}
$conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <link rel="icon" href="image/profile.png" type="image/x-icon">
    <link rel="stylesheet" href="css/styles.css">
    <title>Student Profile</title>
</head>
<body>
    <div class="holder">
    <div class="form">
    <h2>User Information Form</h2>
    <form method="post">

        <label for="student_id">ID:</label><br>
        <input type="int" id="student_id" name="student_id"><br><br>

        <label for="name">Name:</label><br>
        <input type="text" id="Name" name="Name"><br><br>
        
        <label for="age">Age:</label><br>
        <input type="text" id="Age" name="Age"><br><br>
        
        <label for="address">Address:</label><br>
        <input type="text" id="Address" name="Address"><br><br>
        
        <label for="contact_number">Contact Number:</label><br>
        <input type="text" id="ContactNumber" name="ContactNumber"><br><br>
        
        <label for="birthdate">Birthdate:</label><br>
        <input type="date" id="Birthdate" name="Birthdate"><br><br>
        
        <label for="gender">Gender:</label><br>
        <input type="radio" id="male" name="Gender" value="Male">
        <label for="male">Male</label><br>
        <input type="radio" id="female" name="Gender" value="Female">
        <label for="female">Female</label><br><br>
        
        <label for="bloodtype">Blood Type:</label><br>
        <select id="bloodtype" name="Bloodtype">
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="AB">AB</option>
            <option value="O">O</option>
        </select><br><br>

        <input type="submit" name="submit" value="submit">
    </form>
</div>
    
<div class="form">
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $student_id = $_POST['student_id'];
        $name = $_POST['Name'];
        $age = $_POST['Age'];
        $address = $_POST['Address'];
        $contact_number = $_POST['ContactNumber'];
        $birthdate = $_POST['Birthdate'];
        $gender = $_POST['Gender'];
        $bloodtype = $_POST['Bloodtype'];
        
        echo "<h2>User Information:</h2>";
        echo "ID: $student_id <br>";
        echo "Name: $name <br>";
        echo "Age: $age <br>";
        echo "Address: $address <br>";
        echo "Contact Number: $contact_number <br>";
        echo "Birthdate: $birthdate <br>";
        echo "Gender: $gender <br>";
        echo "Blood Type: $bloodtype <br>";
    }
    ?>
    </div>
    </div>

    
    <?php 
$sql = "SELECT * FROM studentlist";

$result = $conn->query($sql);

?>
<div class="container">
        <h2>Student Information</h2>
<table class="table">
    <thead>
        <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Age</th>
        <th>Address</th>
        <th>Contact</th>
        <th>Birthday</th>
        <th>Gender</th>
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
                        <td><?php echo $row['student_id']; ?></td>
                        <td><?php echo $row['Name']; ?></td>
                        <td><?php echo $row['Age']; ?></td>
                        <td><?php echo $row['Address']; ?></td>
                        <td><?php echo $row['ContactNumber']; ?></td>
                        <td><?php echo $row['Birthdate']; ?></td>
                        <td><?php echo $row['Gender']; ?></td>
                        <td><?php echo $row['Bloodtype']; ?></td>
                        <td>
                            <a class="btn btn-info" href="update.php?id=<?php echo $row['student_id']; ?>">Edit</a>&nbsp;
                            <a class="btn btn-danger" name="delete" href="delete.php?id=<?php echo $row['student_id']; ?>">Delete</a>
                        </td>
                    </tr>                       

        <?php       }
            }
        ?>         
        
    </tbody>

</table>
       
</body>
</html>