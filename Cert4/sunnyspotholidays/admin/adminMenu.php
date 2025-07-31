<?php
session_start();

// Check if the user is not logged in
if (empty($_SESSION['loggedin'])) {
    header("Location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Menu</title>
    <link rel="stylesheet" href="../Css/style.css">

</head>
<body>
    <h2>Admin Menu</h2>
    <ul>
        <li><a href="../insertCabin.php">Insert Cabin</a></li>
        <li><a href="../allCabins.php">View All Cabins</a></li>
        <li><a href="../updateCabin.php">Update Cabin</a></li>
        <li><a href="../deleteCabin.php">Delete Cabin</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</body>
</html>
