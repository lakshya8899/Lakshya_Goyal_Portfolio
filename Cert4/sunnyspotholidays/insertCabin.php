<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Cabins</title>
    <link rel="stylesheet" href="./Css/style.css">
</head>

<body>
    <header>
        <img src="images/accommodation.png" alt="Accommodation">
        <h1>Sunnyspot Accommodation</h1>
    </header>

    <div class="container">
        <h1>Insert New Cabin</h1>
        <form method="post" action="" enctype="multipart/form-data">
            <label for="cabinType">Cabin Type:</label>
            <input type="text" id="cabinType" name="cabinType" required><br><br>

            <label for="cabinDescription">Cabin Description:</label>
            <textarea id="cabinDescription" name="cabinDescription" required></textarea><br><br>

            <label for="pricePerNight">Price Per Night:</label>
            <input type="number" id="pricePerNight" name="pricePerNight" required min="0"><br><br>

            <label for="pricePerWeek">Price Per Week:</label>
            <input type="number" id="pricePerWeek" name="pricePerWeek" required><br><br>

            <label for="photo">Photo:</label>
            <input type="file" id="photo" name="photo" accept=".jpg, .jpeg, .png, .gif" ><br><br>

            <input type="submit" value="Insert Cabin">
        </form>
        <br>
        <a href="./admin/adminMenu.php">Back to Admin Menu</a>
    </div>

    <div class="container">
        <h1>All Cabins</h1>
        <?php
        // Fetch cabins to display
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

        $sql = "SELECT cabinID, cabinType, cabinDescription, pricePerNight, pricePerWeek, photo FROM Cabin";
        $result = $conn->query($sql);

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

        // Close connection
        $conn->close();
        ?>
    </div>

    <footer>
        <a href="./admin/adminMenu.php">Admin</a>
    </footer>
</body>

</html>

<?php
// Directory to upload files
$target_dir = "images/";

// Allowed file types
$allowed_types = array("jpg", "jpeg", "png", "gif");

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if file was uploaded without errors
    if (isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0) {
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
    } else {
        if ($_FILES["photo"]["error"] == 4) {
            // No file was uploaded, set default image filename
            $photo = "testCabin.jpg";
        } else {
            // Handle other file upload errors
            echo "Error: File upload error code " . $_FILES["photo"]["error"];
            exit;
        }
    }

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

    // Handle form submission for inserting a new cabin
    $cabinType = $_POST['cabinType'];
    $cabinDescription = $_POST['cabinDescription'];
    $pricePerNight = $_POST['pricePerNight'];
    $pricePerWeek = $_POST['pricePerWeek'];

    if ($pricePerWeek > 5 * $pricePerNight) {
        echo "Error: The price per week cannot be more than 5 times the price per night.";
    } else {
        $sql = "INSERT INTO Cabin (cabinType, cabinDescription, pricePerNight, pricePerWeek, photo)
                VALUES (?, ?, ?, ?, ?)";

        // Prepare and bind the statement
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssiis", $cabinType, $cabinDescription, $pricePerNight, $pricePerWeek, $photo);

        // Execute the statement
        if ($stmt->execute()) {
            echo "New cabin inserted successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close statement
        $stmt->close();
    }

    // Close connection
    $conn->close();
}
?>
