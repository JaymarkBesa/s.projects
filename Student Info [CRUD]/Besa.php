<?php

$serverName = "localhost";
$user = "root";
$pass = "";
$databaseName = "j";

$conn = new mysqli($serverName, $user, $pass, $databaseName);


if ($conn->connect_error) {
    die("Connection Failed: ".$conn->connect_error);

}
echo "Connection Established!";
?>

<?php 


  if (isset($_POST['submit'])) {
   
    $Firstname = $_POST['Firstname'];

    $Lastname = $_POST['Lastname'];

    $Age = $_POST['Age'];

    $Address = $_POST['Address'];

    $Contact = $_POST['Contact'];

    $Birthday = $_POST['Birthday'];


    $sql = "INSERT INTO `m` (`Firstname`, `Lastname`, `Age`, `Address`, `Contact`, `Birthday`) VALUES ('$Firstname','$Lastname','$Age','$Address','$Contact','$Birthday')";

    $result = $conn->query($sql);

    if ($result == TRUE) {

      echo "New record created successfully.";

    }else{

      echo "Error:". $sql . "<br>". $conn->error;

    } 

    $conn->close(); 
  
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Document</title>
</head>
<body>
<h2>Student Profile</h2>

<form action="" method="POST">

  <fieldset>
  <h2>Student Profiles</h2>
    <legend>Student Information:</legend>

    Student ID:<br>

    <input id="ID" type="text" name="ID" value="Auto" readonly>

    <br>

    First name:<br>

    <input type="text" name="Firstname">

    <br>

    Last name:<br>

    <input type="text" name="Lastname">

    <br>

    Age:<br>

    <input type="number" name="Age">

    <br>

    Address:<br>

    <input type="text" name="Address">

    <br>

    Contact Number:<br>
    <input type="phone" name="Contact"><br>

    Birthdate: <br>
    <input type="date" name="Birthday">    
    <br>


    <input id="submit" type="submit" name="submit" value="submit">
 
  </fieldset>

</form>

<?php 


$sql = "SELECT * FROM m";

$result = $conn->query($sql);

?>
<div class="container">

        <h2>STUDENT LIST</h2>

<table class="table">

    <thead>

        <tr>

        <th>STUDENT ID</th>

        <th>First Name</th>

        <th>Last Name</th>

        <th>Age</th>

        <th>Address</th>

        <th>Contact</th>

        <th>Birthday</th>

        <th>Action</th>

    </tr>

    </thead>

    <tbody> 

        <?php

            if ($result->num_rows > 0) {

                while ($row = $result->fetch_assoc()) {

        ?>

                    <tr>
                        <td><?php echo $row['ID']; ?></td>
                        <td><?php echo $row['Firstname']; ?></td>
                        <td><?php echo $row['Lastname']; ?></td>
                        <td><?php echo $row['Age']; ?></td>
                        <td><?php echo $row['Address']; ?></td>
                        <td><?php echo $row['Contact']; ?></td>
                        <td><?php echo $row['Birthday']; ?></td>
                        <td>
                            <a class="btn btn-info" href="update.php?ID=<?php echo $row['ID']; ?>">Edit</a>&nbsp;
                            <a class="btn btn-danger" name="delete" href="delete.php?ID=<?php echo $row['ID']; ?>">Delete</a>
                        </td>
                    </tr>                       

        <?php       }
            }

        ?>                

    </tbody>

</table>




</body>
</html>