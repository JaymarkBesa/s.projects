<!DOCTYPE html>
<html>
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Session 2</title>
      <link rel="stylesheet" href="css/style3.css?v=<?php echo time(); ?>">
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
$thePriority = [];
$sqlthePriority = "SELECT id, name FROM priorities";
$resultThePriority = $conn->query($sqlthePriority);
if ($resultThePriority->num_rows > 0) {
    while ($row = $resultThePriority->fetch_assoc()) {
        $thePriority[] = $row;
    }
}
   if (isset($_GET['AssetID'])) {
    $ID = $_GET['AssetID'];
    $sql = "SELECT emergencymaintenances.*, assets.* 
    FROM `assets` 
    LEFT JOIN `emergencymaintenances` ON assets.ID = emergencymaintenances.AssetID
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
        $PriorityID = $row['PriorityID'];
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
   <?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form
    $assetID = $_POST['AssetID'];
    $priorityID = $_POST['PriorityID'];
    $descriptionEmergency = $_POST['DescriptionEmergency']; // Corrected key
    $otherConsiderations = $_POST['OtherDescription']; // Corrected key
    $emReportDate = date('Y-m-d'); // Get today's date in the format Year-Month-Day
    $emStartDate = $emReportDate; // Assuming EMStartDate should also be today's date

    // Insert data into the emergencymaintenances table
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "session2";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind the INSERT statement
    $stmt = $conn->prepare("INSERT INTO emergencymaintenances (AssetID, PriorityID, DescriptionEmergency, OtherConsiderations, EMReportDate, EMStartDate) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iissss", $assetID, $priorityID, $descriptionEmergency, $otherConsiderations, $emReportDate, $emStartDate);

    // Execute the statement
    if ($stmt->execute()) {
        echo "<script>alert('Successfully Send Request!')</script>";
        header("refresh:1;url=assetlist.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
   <body>
      <div class="container">
      <h4 style="margin-top:12px;">&nbsp Selected Asset</h4>
         <div class="inside-container1">
            <br><br>
            <form method="post">
            <input type="hidden" name="AssetID" value="<?php echo htmlspecialchars($_GET['AssetID']); ?>">
            <label>&nbsp Asset SN:</label>
            <input type="text" name="asset_sn" id="asset_sn" style="width:90px;" value="<?php echo $AssetSN; ?>" readonly>
            <label>&nbsp Asset Name:</label>
            <input type="text" name="asset_name" id="asset_name" style="width:300px;" value="<?php echo $AssetName; ?>" readonly>
            <label>&nbsp Department:</label>
            <?php
            // Loop through departments array to find the matching department
            foreach ($departments as $departmentSel) {
                if ($departmentSel['id'] == $DepartmentID) {
                    $departmentName = $departmentSel['name']; // Set departmentName to the name of the matching department
                    break; // Break the loop once a match is found
                }} ?>
            <input type="text" name="asset_department" id="asset_department" style="width:150px;" value="<?php echo $departmentName; ?>" readonly>
         </div>
        <h4 style="margin-top:112px;">&nbsp Request Report</h4>
         <div class="inside-container2">
         <label for="prioritySelect">&nbsp Select Priority:</label>
         <?php
// Establish a database connection (replace the placeholders with your actual database credentials)
$servername = "localhost";
$username = "root";
$password = "";
$database = "session2";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to select priorities from the database
$query = "SELECT ID, Name FROM priorities";

// Perform the query
$result = $conn->query($query);

// Check if the query was successful
if ($result->num_rows > 0) {
    // Start select dropdown
    echo '<select name="PriorityID" id="prioritySelect">';
    echo '<option value="">---</option>'; // Default option

    // Fetch each row from the result set
    while ($row = $result->fetch_assoc()) {
        // Output an option for each priority
        echo '<option value="' . $row['ID'] . '">' . $row['Name'] . '</option>';
    }

    // End select dropdown
    echo '</select>';
} else {
    // Error handling if no priorities are found
    echo "No priorities found";
}

// Close the database connection
$conn->close();
?><br><br>

        <label>&nbsp Description of Emergency:</label><br>
        <textarea id="descriptionemergency" name="DescriptionEmergency" rows="4" cols="50"></textarea>
        <br><br>
        <label>&nbsp Other Description:</label><br>
        <textarea id="otherdescription" name="OtherDescription" rows="4" cols="50"></textarea>
    
    </div>
    <button type="submit" style="margin-left: 285px;">Send Request</button>
    <button type="button" style="margin-left: 10px;" onclick="goToAssetList()">Cancel</button>
    </form>
<script>
    function goToAssetList() {
        window.location.href = "assetlist.php";
    }
</script>
      </div>
</body>
</html>