<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Define valid credentials
        $validCredentials = [
            'username' => 'l',
            'password' => 'l'
        ];

        if ($username === $validCredentials['username'] && $password === $validCredentials['password']) {
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            header("Location: adminMenu.php");
            exit();
        } else {
            echo "Invalid user";
        }
    }
}


?>

