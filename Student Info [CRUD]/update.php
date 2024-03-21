<?php
//This variable stores the hostname of mysql server.
$serverName = "localhost";

//This variable stores the username used to connect to the MySQL database.
$user = "root";

//This variable stores the pass used to connect to the MySQL database.
$pass = "";

//This variable stores the name of the database yo want to connect to within the MySQL server.
$databaseName = "j";

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

        $ID = $_POST['ID'];

        $Firstname = $_POST['Firstname'];

        $Lastname = $_POST['Lastname'];

        $Age = $_POST['Age'];

        $Address = $_POST['Address'];

        $Contact = $_POST['Contact'];

        $Birthday = $_POST['Birthday'];

        $sql = "UPDATE `m` SET `Firstname`='$Firsname',`Lastname`='$Lastname',`Age`='$Age',`Address`='$Address',`Contact`='$Contact',`Birthday`='$Birthday' WHERE `ID`='$ID'"; 

        $result = $conn->query($sql); 

        if ($result == TRUE) {

            echo "Record updated successfully.";

        }else{

            echo "Error:" . $sql . "<br>" . $conn->error;

        }

    } 

if (isset($_GET['ID'])) {

    $ID = $_GET['ID']; 

    $sql = "SELECT * FROM `m` WHERE `ID`='$ID'";

    $result = $conn->query($sql); 

    if ($result->num_rows > 0) {        

        while ($row = $result->fetch_assoc()) {

            $Firstname = $row['Firstname'];

            $Lastname = $row['Lastname'];

            $Age = $row['Age'];
            
            $Address = $row['Address'];

            $Contact  = $row['Contact'];

            $Birthday = $row['Birthday'];

            $ID = $row['ID'];

        } 

?>

        <h2>Student Profile Update Form</h2>

        <form action="" method="post">

          <fieldset>

            <legend>Personal information:</legend>

            First name:<br>

            <input type="text" name="Firstname" value="<?php echo $Firstname; ?>">

            <input type="hidden" name="ID" value="<?php echo $ID; ?>">

            <br>

            Last name:<br>

            <input type="text" name="Lastname" value="<?php echo $Lastname; ?>">

            <br>

            Age:<br>

            <input type="number" name="Age" value="<?php echo $Age; ?>">

            <br>

            Address:<br>

            <input type="text" name="Address" value="<?php echo $Address; ?>">

            <br>
            Contact:<br>

            <input type="phone" name="Contact" value="<?php echo $Contact; ?>">

            <br>

            Birthdate:<br>

            <input type="date" name="Birthday" value="<?php echo $Birthday;?>">

            
            <br><br>

            <input type="submit" value="Update" name="update">

          </fieldset>

        </form> 



</body>
</html>
<?php
} else { 

    header('Location: Besa.php');
} 
}
?> 