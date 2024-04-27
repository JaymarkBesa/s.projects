<!DOCTYPE html>
<html>
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Request Form</title>
      <link rel="stylesheet" href="css/style5.css?v=<?php echo time(); ?>">
   </head>

<?php 
// Create connection
$conn = new mysqli("localhost", "root", "", "session2");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$departments = [];
$sqlDepartments = "SELECT id, name FROM departments";
$resultDepartments = $conn->query($sqlDepartments);
if ($resultDepartments->num_rows > 0) {
    while ($row = $resultDepartments->fetch_assoc()) {
        $departments[] = $row;
    }
}

$departmentlocs = [];
$sqlDepartmentlocs = "SELECT id, name FROM locations";
$resultDepartmentlocs = $conn->query($sqlDepartmentlocs);
if ($resultDepartmentlocs->num_rows > 0) {
    while ($row = $resultDepartmentlocs->fetch_assoc()) {
        $departmentlocs[] = $row;
    }
}

$theParts = [];
$sqltheParts = "SELECT id, name FROM parts";
$resultTheParts = $conn->query($sqltheParts);
if ($resultTheParts->num_rows > 0) {
    while ($row = $resultTheParts->fetch_assoc()) {
        $theParts[] = $row;
    }
}

   if (isset($_GET['AssetID'])) {
    $ID = $_GET['AssetID'];
    $sql = "SELECT emergencymaintenances.*, assets.*, changedparts.* 
    FROM `assets` 
    LEFT JOIN `emergencymaintenances` ON assets.ID = emergencymaintenances.AssetID
    LEFT JOIN `changedparts` ON emergencymaintenances.ID = changedparts.EmergencyMaintenanceID
    WHERE assets.ID = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $ID);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $AssetSN = $row['AssetSN'];
        $AssetName = $row['AssetName'];
        $DepartmentLocationID = $row['DepartmentLocationID'];
        $Amount = $row['Amount'];
        $PartID = $row['PartID'];
        $EMStartDate = $row['EMStartDate'];
        $EMReportDate = $row['EMReportDate'];
        $EMEndDate = $row['EMEndDate'];
        $DescriptionEmergency = $row['DescriptionEmergency'];
        $OtherConsiderations = $row['OtherConsiderations'];
        $sql = "SELECT * FROM `departmentlocations` WHERE `ID`=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $DepartmentLocationID);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $DepartmentID = $row['DepartmentID'];
            $LocationID = $row['LocationID'];
        }        
    }
} 
?>

   <body>

      <div class="container">
      <h4 style="margin-top:12px;">&nbsp Selected Asset</h4>
         <div class="inside-container1">
            <br>
            <label>&nbsp Asset SN:</label>
            <input type="text" name="asset_sn" id="asset_sn" style="width:90px;" value="<?php echo $AssetSN; ?>" readonly>
            <label>&nbsp Asset Name:</label>
            <input type="text" name="asset_name" id="asset_name" style="width:300px;" value="<?php echo $AssetName; ?>" readonly>
            <label>&nbsp Department:</label>
            <?php
            foreach ($departments as $departmentSel) {
                if ($departmentSel['id'] == $DepartmentID) {
                    $departmentName = $departmentSel['name']; // Set departmentName to the name of the matching department
                    break; // Break the loop once a match is found
                }} ?>
            <input type="text" name="asset_department" id="asset_department" style="width:150px;" value="<?php echo $departmentName; ?>" readonly>
         </div>
         <form method="post">
        <h4 style="margin-top:60px;">&nbsp Asset EM Report</h4>
         <div class="inside-container2"><br>
         <label for="prioritySelect">&nbsp Start Date:</label>
         <input type="date" id="startDate" name="date" value="<?php echo $EMStartDate; ?>" readonly>
         <label for="prioritySelect" style="margin-left:100px;"> Completed On:</label>
         <input type="date" id="endDate" name="endDate"><br><br>
         <label for="prioritySelect">&nbsp Technician Note:</label><br>
         <textarea id="technicianNote" name="technicianNote" rows="4" cols="50"></textarea>

    </div>
    <h4 style="margin-top:210px;">&nbsp Replacement Parts</h4>
    <div class="inside-container3">
        <label>&nbsp Part Name:</label>
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

// SQL query to fetch data from the 'parts' table
$sql = "SELECT ID, Name FROM parts";
$result = $connection->query($sql);

// Check if there are any rows returned
if ($result->num_rows > 0) {
    echo '<select name="parts">'; // Start select element
    while ($row = $result->fetch_assoc()) {
        // Output an option for each row in the result set
        echo '<option value="' . $row['ID'] . '">' . $row['Name'] . '</option>';
    }
    echo '</select>'; // End select element
} else {
    echo "0 results"; // Output if no rows are found
}

// Close connection
$connection->close();
?>

<label style="margin-left:20px;">Amount:</label>
<input type="number" name="amount" style="width: 100px;" id="amount">
<input type="button" value="+ Add to List" style="margin-left: 50px;" onclick="addToTable()">


<table id="partTable">
    <thead>
        <tr>
            <th class="hidden">ID</th>
            <th>Part Name</th>
            <th>Amount</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>

    </tbody>
</table>
    </div>
    <input type="hidden" id="partDataInput" name="partData">
    <button type="submit" style="margin-left: 285px;" id="request">Submit</button>
    <button type="button" style="margin-left: 10px; " id="cancel"  header="Location: reqManagement.php;">Cancel</button>
</form>
      </div>


<script>
document.getElementById("cancel").addEventListener("click", function() {
    // Redirect to the specified page
    window.location.href = "reqManagement.php";
});

var partData = []; // Array to store part IDs and amounts

function addToTable() {
    // Get selected part ID, name, and amount
    var partSelect = document.querySelector('select[name="parts"]');
    var partId = partSelect.value; // PartID from the value attribute
    var partName = partSelect.options[partSelect.selectedIndex].textContent; // Part name from the selected option's text content
    var amount = document.querySelector('input[name="amount"]').value;

    // Log the row data to the console
    console.log("Part ID: " + partId + ", Amount: " + amount);
    
    // Push the part ID and amount to the array
    partData.push({ partId: partId, amount: amount });
    
    // Get table body
    var tableBody = document.querySelector('#partTable tbody');
    
    // Create new row
    var newRow = document.createElement('tr');
    
    // Create cells for part ID, name, and amount
    var partIdCell = document.createElement('td');
    partIdCell.textContent = partId;
    partIdCell.style.display = 'none';
    var partNameCell = document.createElement('td');
    partNameCell.textContent = partName;
    var amountCell = document.createElement('td');
    amountCell.textContent = amount;
    
    // Create delete button cell
    var deleteCell = document.createElement('td');
    var deleteButton = document.createElement('button');
    deleteButton.textContent = 'Delete';
    deleteButton.addEventListener('click', function() {
        // Remove the row when delete button is clicked
        newRow.remove();
        // Remove the deleted row data from partData array
        partData.splice(partData.findIndex(row => row.partId === partId), 1);
        // Update the hidden input field with the updated partData array
        document.getElementById('partDataInput').value = JSON.stringify(partData);
    });
    deleteCell.appendChild(deleteButton);
    
    // Append cells to new row
    newRow.appendChild(partIdCell);
    newRow.appendChild(partNameCell);
    newRow.appendChild(amountCell);
    newRow.appendChild(deleteCell);
    
    // Append new row to table body
    tableBody.appendChild(newRow);

    // Update the hidden input field with the updated partData array
    document.getElementById('partDataInput').value = JSON.stringify(partData);
}

</script>
<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$database = "session2";

// Create connection
$connection = new mysqli($servername, $username, $password, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the ID from the URL
    $id = $_GET['ID'];

    // Update emergencymaintenances table
    $endDate = $_POST['endDate'];
    $formattedEndDate = date("Y/m/d", strtotime($endDate)); // Format the date
    $technicianNote = $_POST['technicianNote'];

    // Update query for emergencymaintenances table
    $updateQuery = "UPDATE emergencymaintenances SET EMEndDate = '$formattedEndDate', EMTechnicianNote = '$technicianNote' WHERE ID = $id";

    // Execute the update query
    $updateResult = $connection->query($updateQuery);
    if (!$updateResult) {
        echo "Error updating emergencymaintenances table: " . $connection->error;
    }

    // Decode the JSON string into an associative array
    $partData = json_decode($_POST['partData'], true);

    // Check if decoding was successful
    if ($partData === null) {
        // Handle the error (e.g., invalid JSON string)
        echo "Error decoding JSON data.";
    } else {
        // Iterate over each part in the $partData array
        foreach ($partData as $part) {
            // Access partId and amount for each part
            $partID = $part['partId'];
            $amount = $part['amount'];

            // Insert query for changeparts table
            $insertQuery = "INSERT INTO changedparts (EmergencyMaintenanceID, PartID, Amount) VALUES ($id, $partID, $amount)";

            // Execute the insert query
            $insertResult = $connection->query($insertQuery);
            if (!$insertResult) {
                echo "Error inserting data into changeparts table: " . $connection->error;
            }
        }

        echo '<script>alert("Request successfully managed. Redirecting back to the table.");</script>';
        echo '<script>window.location.href = "reqManagement.php";</script>';
        exit();
    }
}

// Close connection
$connection->close();
?>



</body>
</html>