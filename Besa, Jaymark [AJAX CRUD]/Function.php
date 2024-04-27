<?php
require 'Config.php';

if(isset($_POST["action"])){
    if($_POST["action"] == "submit"){
        submit();
    } elseif ($_POST["action"] == "edit") {
        edit();
    } elseif ($_POST["action"] == "delete") {
        delete();
    }
}

function submit(){
    global $conn;
    $Name = mysqli_real_escape_string($conn, $_POST["Name"]);
    $Email = mysqli_real_escape_string($conn, $_POST["Email"]);
    $Gender = mysqli_real_escape_string($conn, $_POST["Gender"]);

    $query = "INSERT INTO `users` (`Name`, `Email`, `Gender`) VALUES ('$Name','$Email','$Gender')";
    if(mysqli_query($conn, $query)) {
        echo "Insert Successfully";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

function edit(){
    global $conn;
    
    // Check if ID is set and not empty
    if(isset($_POST["id"]) && !empty($_POST["id"])) {
        $id = mysqli_real_escape_string($conn, $_POST["id"]);
        $Name = mysqli_real_escape_string($conn, $_POST["Name"]);
        $Email = mysqli_real_escape_string($conn, $_POST["Email"]);
        $Gender = mysqli_real_escape_string($conn, $_POST["Gender"]);

        $query = "UPDATE `users` SET `Name` = '$Name', `Email` = '$Email', `Gender` = '$Gender' WHERE id = $id";
        if(mysqli_query($conn, $query)) {
            echo "Updated Successfully";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "Error: ID is missing or empty";
    }
}

function delete(){
    global $conn;
    
    $id = $_POST["id"];

    $query = "DELETE FROM `users` WHERE id = $id";
    if(mysqli_query($conn, $query)) {
        echo "Deleted Successfully";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
