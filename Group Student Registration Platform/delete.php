<?php
//This variable stores the hostname of mysql server.
$serverName = "localhost";
//This variable stores the username used to connect to the MySQL database.
$user = "root";
//This variable stores the pass used to connect to the MySQL database.
$pass = "";
//This variable stores the name of the database yo want to connect to within the MySQL server.
$databaseName = "godlovesme";
//Establishing the connection between php and your database
$conn = new mysqli($serverName, $user, $pass, $databaseName);
//Checking the connection if its successfully established or not
if ($conn->connect_error) {
    die("Connection Failed: ".$conn->connect_error);
}
?>
<?php 


if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
    $sql = "DELETE FROM `tbinformation` WHERE `user_id`='$user_id'";
    $result = $conn->query($sql);
    if ($result === TRUE) {
        echo "Record deleted successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

?>
<?php
if (isset($_GET['user_id'])) {
$user_id = $_GET['user_id']; 
$sql = "SELECT * FROM `tbinformation` WHERE `user_id`='$user_id'";
$result = $conn->query($sql); 
if ($result->num_rows > 0) {        
    while ($row = $result->fetch_assoc()) {
        $user_id = $_GET['user_id'];
        echo "User ID: " . $user_id; // Retrieve user_id from session
        $Name = $_POST['name'];
        $Age = $_POST['age'];
        $Address = $_POST['address'];
        $Contact = $_POST['contact'];
        $Birthday = $_POST['birthday'];
        $Gender = $_POST['gender'];
        $Gmail = $_POST['gmail'];
        $Bloodtype = $_POST['bloodtype'];
    } 
?>
 <form action="#" method="post" class="student-form">
        <h2>Student Information</h2>
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php if(isset($row['name'])) echo $row['name']; ?>" required>
        </div>
        
        <div class="form-group">
            <label for="age">Age:</label>
            <input type="number" id="age" name="age" value="<?php if(isset($row['age'])) echo $row['age']; ?>" required>
        </div>
        
        <div class="form-group">
            <label for="address">Address:</label>
            <textarea id="address" name="address" required><?php if(isset($row['address'])) echo $row['address']; ?></textarea>
        </div>
        
        <div class="form-group">
            <label for="contact">Contact:</label>
            <input type="tel" id="contact" name="contact" value="<?php if(isset($row['contact'])) echo $row['contact']; ?>" required>
        </div>
        
        <div class="form-group">
            <label for="birthday">Birthday:</label>
            <input type="date" id="birthday" name="birthday" value="<?php if(isset($row['birthday'])) echo $row['birthday']; ?>" required>
        </div>
        
        <div class="form-group">
            <label for="gender">Gender:</label>
            <select id="gender" name="gender" required>
                <option value="male" <?php if(isset($row['gender']) && $row['gender'] == 'male') echo 'selected'; ?>>Male</option>
                <option value="female" <?php if(isset($row['gender']) && $row['gender'] == 'female') echo 'selected'; ?>>Female</option>
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

    </body>
    </html>
<?php
} else { 

    header('Location: information.php');
} 
}
?> 