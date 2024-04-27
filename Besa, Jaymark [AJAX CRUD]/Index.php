<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <title>Index</title>
</head>
<body>
    <h2>Index</h2>
    <div class="container">
    <table Border="1">
        <tr>
            <td>#</td>
            <td>Name</td>
            <td>Email</td>
            <td>Gender</td>
            <td>Action</td>
        </tr>
        <?php
        require 'Config.php';

        // Fetch rows from the database
        $result = mysqli_query($conn, "SELECT * FROM users");
        $i = 1;

        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
        ?>
                <tr id="<?php echo $row["ID"]; ?>">
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $row["Name"]; ?></td>
                    <td><?php echo $row["Email"]; ?></td>
                    <td><?php echo $row["Gender"]; ?></td>
                    <td>
    <a href="Edituser.php?id=<?php echo $row['ID']; ?>">Edit</a>

    <form id="deleteForm<?php echo $row['ID']; ?>" method="post" action="Function.php">
        <input type="hidden" name="id" value="<?php echo $row['ID']; ?>">
        <button type="submit" name="action" value="delete">Delete</button>
    </form>
</td>
                </tr>
        <?php
            }
            mysqli_free_result($result);
        } else {
            echo "Error: " . mysqli_error($conn);
        }
        ?>
    </table>
    <br>
    <a href="Adduser.php">Add User</a>
    </div>
    <?php require 'Script.php'; ?>
</body>
</html>
