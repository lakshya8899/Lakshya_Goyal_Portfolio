<?php
// Database connection details
$servername = "localhost";
$username = "root"; // replace with your MySQL username
$password = ""; // replace with your MySQL password
$dbname = "SunnySpot_Goyal_Lakshya";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate input (you may want to add more robust validation)
    $cabinID = $_POST['cabinID'];
    
    // Check if cabinID is not empty
    if (!empty($cabinID)) {
        // Check if there are related records in the cabininclusion table
        $check_query = "SELECT COUNT(*) AS count FROM cabininclusion WHERE cabinID = ?";
        $check_stmt = $conn->prepare($check_query);
        $check_stmt->bind_param("s", $cabinID);
        $check_stmt->execute();
        $check_result = $check_stmt->get_result();
        $count = $check_result->fetch_assoc()['count'];
        
        if ($count > 0) {
            // Delete related records in the cabininclusion table
            $delete_query = "DELETE FROM cabininclusion WHERE cabinID = ?";
            $delete_stmt = $conn->prepare($delete_query);
            $delete_stmt->bind_param("s", $cabinID);
            $delete_stmt->execute();
        }
        
        // Now delete the cabin
        $delete_cabin_query = "DELETE FROM Cabin WHERE cabinID = ?";
        $delete_cabin_stmt = $conn->prepare($delete_cabin_query);
        $delete_cabin_stmt->bind_param("s", $cabinID);
        
        if ($delete_cabin_stmt->execute()) {
            echo "Cabin deleted successfully";
        } else {
            echo "Error executing deletion: " . $delete_cabin_stmt->error;
        }
    } else {
        echo "CabinID is empty";
    }
}

// Fetch cabins to display
$sql = "SELECT cabinID, cabinType, cabinDescription, pricePerNight, pricePerWeek, photo FROM Cabin";
$result = $conn->query($sql);

// Close connection
$conn->close();
?>




<!DOCTYPE html>
<html>

<head>
    <title>Delete Cabin</title>
    <link rel="stylesheet" href="./Css/style.css">

</head>

<body>
    <h1>Delete Cabin</h1>
    <form method="post" action="">
        <label for="cabinID">Cabin ID:</label>
        <input type="number" id="cabinID" name="cabinID" required><br><br>
        <input type="submit" value="Delete Cabin">
    </form>
    
    <div class="container">
        <h1>All Cabins</h1>
        <?php
        // Check if there are any results
        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                // Store each field directly
                $cabinID = $row["cabinID"];
                $cabinType = $row["cabinType"];
                $cabinDescription = $row["cabinDescription"];
                $pricePerNight = $row["pricePerNight"];
                $pricePerWeek = $row["pricePerWeek"];
                $photo = $row["photo"];

                // Display the data
                echo "<p>Cabin ID: {$cabinID}</p>";
                echo "<div class='cabin'>";
                echo "<h2>{$cabinType}</h2>";
                echo "<p>{$cabinDescription}</p>";
                echo "<p>Price per night: \${$pricePerNight}</p>";
                echo "<p>Price per week: \${$pricePerWeek}</p>";
                echo "<img src='images/{$photo}' alt='{$cabinType}'>";
                echo "</div>";
            }
        } else {
            echo "<p>No results found.</p>";
        }
        ?>
    </div>

    
    <footer>
        <a href="./admin/adminMenu.php">Admin</a>
    </footer>

</html>