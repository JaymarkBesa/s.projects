<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/edit.css">
    <title>Edit User</title>
</head>
<body>
    <h2>Edit User</h2>
    <div class="container">
    <form autocomplete="off" action="Function.php" method="post">
        <?php require 'config.php' ;
        $id = $_GET["id"] ;
        $rows = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `users` WHERE id = $id"));
        ?>
        <input type="hidden" id="id" name="id" value="<?php echo $rows['ID']; ?>">
        <label for="">Name</label>      
        <input type="text" id="name" name="Name"value="<?php echo $rows['Name']; ?>">
        <label for="">Email</label>
        <input type="text" id="email" name="Email"value="<?php echo $rows['Email']; ?>">
        <label for="">Gender</label>
        <select class="" id="gender" name="Gender">
            <option value="Male" <?php if($rows["Gender"] == "Male") echo "selected"; ?> >Male<option>
            <option value="Female" <?php if($rows["Gender"] == "Female") echo "selected"; ?> >Female<option>
</select> <br>
<input type="hidden" name="action" value="edit">
    <button type="submit" name="edit">Edit</button>
</form>
<br>
<a href="Index.php">Go To Index</a>
</div>
<?php require 'Script.php' ; ?>
</body>
</html>