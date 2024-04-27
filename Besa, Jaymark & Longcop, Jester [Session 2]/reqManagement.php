<!DOCTYPE html>
<html>
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Request Management</title>
      <link rel="stylesheet" href="css/style4.css?v=<?php echo time(); ?>">
   </head>
   <body>

      <div class="container">
      <h4 style="margin-top:12px;">&nbsp List of Assets Requesting EM:</h4>
         <div class="inside-container">
         <table id="myTable">
        <thead>
            <tr>
                <th>Asset SN</th>
                <th>Asset Name</th>
                <th>Request Date</th>
                <th>Employee Full Name</th>
                <th>Department</th>
            </tr>
        </thead>
        <tbody>
        <?php
// Replace 'your_database_connection_info' with your actual database connection information
$servername = "localhost"; // Change this to your MySQL server address
$username = "root"; // Change this to your MySQL username
$password = ""; // Change this to your MySQL password if you have one, otherwise leave it empty
$database = "Session2";

// Create connection
$connection = new mysqli($servername, $username, $password, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// SQL query to fetch data
$sql = "SELECT 
            emergencymaintenances.ID AS ID,
            emergencymaintenances.AssetID AS AssetID,
            assets.AssetSN AS AssetSN,
            assets.AssetName AS AssetName,
            emergencymaintenances.EMReportDate AS RequestDate,
            CONCAT(employees.FirstName, ' ', employees.LastName) AS EmployeeFullName,
            departments.Name AS Department
        FROM 
            emergencymaintenances
        JOIN 
            assets ON emergencymaintenances.AssetID = assets.ID
        JOIN 
            employees ON emergencymaintenances.ID = employees.ID
        JOIN 
            departments ON employees.ID = departments.ID
        WHERE 
            emergencymaintenances.EMEndDate IS NULL";

$result = $connection->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo '<td class="hidden">'.$row["ID"].'</td>';
        echo '<td class="hidden">'.$row["AssetID"]."</td>";
        echo "<td>".$row["AssetSN"]."</td>";
        echo "<td>".$row["AssetName"]."</td>";
        echo "<td>".$row["RequestDate"]."</td>";
        echo "<td>".$row["EmployeeFullName"]."</td>";
        echo "<td>".$row["Department"]."</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='6'>0 results</td></tr>";
}

$connection->close();
?>


        </tbody>
    </table>
    


    </div>
    <button id="manageRequestButton" type="button">Manage Request</button>
    <a href="index.php"><button>Sign-Out</button></a>
      

      </div>

      <script>
document.addEventListener("DOMContentLoaded", function() {
    const rows = document.querySelectorAll("#myTable tbody tr");
    const manageRequestButton = document.getElementById("manageRequestButton");

    rows.forEach(row => {
        row.addEventListener("click", () => {
            // Remove 'selected' class from all rows
            rows.forEach(r => r.classList.remove("selected"));
            // Add 'selected' class to the clicked row
            row.classList.add("selected");
        });
    });

    manageRequestButton.addEventListener("click", function() {
        const selectedRow = document.querySelector("#myTable tbody tr.selected");
        if (selectedRow) {
            const selectedId = selectedRow.querySelector("td:first-child").innerText; // Assuming ID is in the first column
            const selectedAssetId = selectedRow.querySelector("td:nth-child(2)").innerText; // Assuming AssetID is in the second column
            window.location.href = "reqForm.php?ID=" + encodeURIComponent(selectedId) + "&AssetID=" + encodeURIComponent(selectedAssetId);
        } else {
            alert("Please select a row before sending the request.");
        }
    });
});
</script>
</body>
</html>