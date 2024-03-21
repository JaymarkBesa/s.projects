<?php
//This variable stores the hostname of mysql server.
$serverName = "localhost";

//This variable stores the username used to connect to the MySQL database.
$user = "root";

//This variable stores the pass used to connect to the MySQL database.
$pass = "";

//This variable stores the name of the database yo want to connect to within the MySQL server.
$databaseName = "demodb";

//Establishing the connection between php and your database
$conn = new mysqli($serverName, $user, $pass, $databaseName);

//Checking the connection if its successfully established or not
if ($conn->connect_error) {
    die("Connection Failed: ".$conn->connect_error);

}
echo "Connection Established!";
?>
<?php 

if (isset($_POST['delete'])) {

    $id = $_POST['demo_id'];

    $sql = "DELETE FROM `dbtable` WHERE `demo_id`='$id'";

     $result = $conn->query($sql);

     if ($result == TRUE) {

        echo "Record deleted successfully.";

    }else{

        echo "Error:" . $sql . "<br>" . $conn->error;

    }

} 

?>
<?php
if (isset($_GET['id'])) {

$id = $_GET['id']; 

$sql = "SELECT * FROM `dbtable` WHERE `demo_id`='$id'";

$result = $conn->query($sql); 

if ($result->num_rows > 0) {        

    while ($row = $result->fetch_assoc()) {

        $first_name = $row['firstname'];

        $last_name = $row['lastname'];

        $age = $row['age'];
        
        $address = $row['address'];

        $contact  = $row['contact'];

        $birthday = $row['birthday'];

        $id = $row['demo_id'];

    } 

?>

    <h2>Student Profile Delete Form</h2>

    <form action="" method="post">

      <fieldset>

        <legend>Personal information:</legend>

        First name:<br>

        <input readonly type="text" name="firstname" value="<?php echo $first_name; ?>">

        <input readonly type="hidden" name="demo_id" value="<?php echo $id; ?>">

        <br>

        Last name:<br>

        <input readonly type="text" name="lastname" value="<?php echo $last_name; ?>">

        <br>

        Age:<br>

        <input readonly type="number" name="age" value="<?php echo $age; ?>">

        <br>

        Address:<br>

        <input readonly type="text" name="address" value="<?php echo $address; ?>">

        <br>
        Contact:<br>

        <input readonly type="phone" name="contact" value="<?php echo $contact; ?>">

        <br>

        Birthdate:<br>

        <input readonly type="date" name="birthday" value="<?php echo $birthday;?>">

        
        <br><br>

        <input type="submit" value="Delete" name="delete">

      </fieldset>

    </form> 
    </body>
    </html>
<?php
} else { 

    header('Location: demoDB.php');

} 
}
?> 