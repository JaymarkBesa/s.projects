<!DOCTYPE html>
<html>
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Session 2</title>
      <link rel="stylesheet" href="css/style2.css?v=<?php echo time(); ?>">
   </head>
   
 

   <body>

      <div class="container">
      <h4 style="margin-top:12px;">&nbsp Available Assets</h4>
         <div class="inside-container">
         <table id="myTable">
        <thead>
            <tr>
                <th>Asset SN</th>
                <th>Asset Name</th>
                <th>Last Closed EM</th>
                <th>Number of EMs</th>
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

// SQL query to retrieve data
$sql = "SELECT 
            assets.ID,
            assets.AssetSN,
            assets.AssetName,
            MAX(emergencymaintenances.EMEndDate) AS LastClosedEM,
            COUNT(DISTINCT emergencymaintenances.ID) AS NumberOfEMs
        FROM 
            assets
        LEFT JOIN 
            emergencymaintenances ON assets.ID = emergencymaintenances.AssetID
        GROUP BY 
            assets.ID, assets.AssetSN, assets.AssetName";

                $result = $connection->query($sql);

                if ($result->num_rows > 0) {
                    // Output data of each row
                    while($row = $result->fetch_assoc()) {
                        // Check if NumberOfEMs is 0
                        if ($row["NumberOfEMs"] == 0) {
                            // If NumberOfEMs is 0, set background color to red and text color to white for all cells except the ID column
                            echo "<tr id='ZeroNum'>";
                            foreach ($row as $key => $value) {
                                echo "<td>".$value."</td>";
                            }
                            echo "</tr>";
                        } else {
                            // If NumberOfEMs is not 0, use normal colors for all cells
                            echo "<tr>";
                            foreach ($row as $value) {
                                echo "<td>".$value."</td>";
                            }
                            echo "</tr>";
                        }
                    }
                } else {
                    // Output if no results found
                    echo "<tr><td colspan='5'>0 results</td></tr>";
                }

                $connection->close();
                ?>
                </tbody>
            </table>
        </div>
    
    <button id="sendRequestButton" type="button">Send Emergency Maintenance Request</button>
    <a href="index.php"><button>Sign-Out</button></a>
</div>

      <script>
document.addEventListener("DOMContentLoaded", function() {
        const rows = document.querySelectorAll("#myTable tbody tr");
        const manageRequestButton = document.getElementById("sendRequestButton");

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
                window.location.href = "sendrequest.php?AssetID=" + encodeURIComponent(selectedId);
            } else {
                alert("Please select a row before sending the request.");
            }
        });
    });
</script>


</body>
</html>