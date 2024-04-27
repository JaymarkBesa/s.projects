<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/add.css">
    <title>Add User</title>
</head>
<body>
    <div class="container">
    <h2>Add User</h2>
    <form id="myForm" autocomplete="off" action="Function.php" method="post">
    <label for="name">Name</label>
    <input type="text" id="name" name="Name" value="" required> <br>
    <label for="email">Email</label>
    <input type="email" id="email" name="Email" value="" required> <br>
    <label for="gender">Gender</label>
    <select id="gender" name="Gender" required>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
    </select> <br>
    <input type="hidden" name="action" value="submit">
    <button type="submit" name="submit">Insert</button>
</form>
<div id="submissionMessage"></div>
<a href="Index.php" style="display: block; text-align: center; margin-top: 20px;">Go To Index</a>
</div>
<br>

<?php require 'Script.php' ; ?>
<div id="submissionMessage"></div>
</body>
</html>