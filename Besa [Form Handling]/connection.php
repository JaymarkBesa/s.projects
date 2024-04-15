<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "formhandling";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Name = $_POST['Name'];      
    $Email = $_POST['Email'];   
    $Message = $_POST['Message']; 

    $sql = "INSERT INTO `information` (`Name`, `Email`, `Message`) VALUES ('$Name', '$Email', '$Message')";
    if ($conn->query($sql) === TRUE) {
        echo "Form submitted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>
