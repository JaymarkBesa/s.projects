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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php 

    if (isset($_POST['update'])) {

        $id = $_POST['demo_id'];

        $first_name = $_POST['firstname'];

        $last_name = $_POST['lastname'];

        $age = $_POST['age'];

        $address = $_POST['address'];

        $contact = $_POST['contact'];

        $birthday = $_POST['birthday'];

        $sql = "UPDATE `dbtable` SET `firstname`='$first_name',`lastname`='$last_name',`age`='$age',`address`='$address',`contact`='$contact',`birthday`='$birthday' WHERE `demo_id`='$id'"; 

        $result = $conn->query($sql); 

        if ($result == TRUE) {

            echo "Record updated successfully.";

        }else{

            echo "Error:" . $sql . "<br>" . $conn->error;

        }

    } 

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

        <h2>Student Profile Update Form</h2>

        <form action="" method="post">

          <fieldset>

            <legend>Personal information:</legend>

            First name:<br>

            <input type="text" name="firstname" value="<?php echo $first_name; ?>">

            <input type="hidden" name="demo_id" value="<?php echo $id; ?>">

            <br>

            Last name:<br>

            <input type="text" name="lastname" value="<?php echo $last_name; ?>">

            <br>

            Age:<br>

            <input type="number" name="age" value="<?php echo $age; ?>">

            <br>

            Address:<br>

            <input type="text" name="address" value="<?php echo $address; ?>">

            <br>
            Contact:<br>

            <input type="phone" name="contact" value="<?php echo $contact; ?>">

            <br>

            Birthdate:<br>

            <input type="date" name="birthday" value="<?php echo $birthday;?>">

            
            <br><br>

            <input type="submit" value="Update" name="update">

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