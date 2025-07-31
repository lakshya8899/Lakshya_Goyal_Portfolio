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



// Check if the "keepImage" checkbox is checked
if (isset($_POST['keepImage']) && $_POST['keepImage'] == '1') {
    // If the checkbox is checked, keep the existing image
    $photo = '';
} else {
    // Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cabinID = $_POST['cabinID'];
    $cabinType = $_POST['cabinType'];
    $cabinDescription = $_POST['cabinDescription'];
    $pricePerNight = $_POST['pricePerNight'];
    $pricePerWeek = $_POST['pricePerWeek'];
    $photo = ''; // Initialize $photo variable
 
    // Check if a new photo is provided
    if (isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0) {
        // Directory to upload files
        $target_dir = "images/";
 
        // Allowed file types
        $allowed_types = array("jpg", "jpeg", "png", "gif");
 
        $file_name = $_FILES["photo"]["name"];
        $file_size = $_FILES["photo"]["size"];
        $file_tmp = $_FILES["photo"]["tmp_name"];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
 
        // Check file size (e.g., limit to 2MB)
        if ($file_size > 2097152) {
            echo "Error: File size is larger than the allowed limit.";
            exit;
        }
 
        // Verify file extension
        if (!in_array($file_ext, $allowed_types)) {
            echo "Error: Only JPG, JPEG, PNG, and GIF files are allowed.";
            exit;
        }
 
        // Generate a unique file name
        $default_file_name = uniqid("img_", true) . "." . $file_ext;
        $target_file = $target_dir . $default_file_name;
 
        // Check if a file with the same name already exists
        if (file_exists($target_file)) {
            echo "Error: A file with the same name already exists.";
            exit;
        }
 
        // Move the file to the target directory
        if (move_uploaded_file($file_tmp, $target_file)) {
            $photo = $default_file_name;
        } else {
            echo "Error: There was a problem uploading your file.";
            exit;
        }
    }
 
    // Prepare the SQL statement
    $sql = "UPDATE Cabin SET cabinType=?, cabinDescription=?, pricePerNight=?, pricePerWeek=?, photo=? WHERE cabinID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssisi", $cabinType, $cabinDescription, $pricePerNight, $pricePerWeek, $photo, $cabinID);
 
    // Execute the statement
    if ($stmt->execute()) {
        echo "Cabin updated successfully";
    } else {
        echo "Error updating cabin: " . $stmt->error;
    }
 }
}


// Fetch cabins to display
$sql = "SELECT cabinID, cabinType, cabinDescription, pricePerNight, pricePerWeek, photo FROM Cabin";
$result = $conn->query($sql);

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Update Existing Cabin</title>
   <link rel="stylesheet" href="./Css/style.css">
</head>
<body>
   <header>
       <img src="images/accommodation.png" alt="Accommodation">
       <h1>Sunnyspot Accommodation</h1>
   </header>

   <div class="container">
       <h1>Update Existing Cabin</h1>
       <form method="post" action="" enctype="multipart/form-data">
           <label for="cabinID">Cabin ID:</label>
           <input type="number" id="cabinID" name="cabinID" required><br><br>

           <label for="cabinType">Cabin Type:</label>
           <input type="text" id="cabinType" name="cabinType" required><br><br>

           <label for="cabinDescription">Cabin Description:</label>
           <textarea id="cabinDescription" name="cabinDescription" required></textarea><br><br>

           <label for="pricePerNight">Price Per Night:</label>
           <input type="number" id="pricePerNight" name="pricePerNight" required><br><br>

           <label for="pricePerWeek">Price Per Week:</label>
           <input type="number" id="pricePerWeek" name="pricePerWeek" required><br><br>

           <label for="photo">To replace file upload image</label>
           <input type="file" id="photo" name="photo" accept=".jpg, .jpeg, .png, .gif"><br><br>

           <input type="checkbox" id="keepImage" name="keepImage" value="1">
            <label for="keepImage">To keep the same image click checkbox</label><br>

           <input type="submit" value="Update Cabin">
       </form>

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
               echo "<img src='images/{$photo}' alt='cabin' class='cabin-image'>";
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
</body>
</html>
