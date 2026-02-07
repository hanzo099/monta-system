<?php
$host = 'localhost';
$db   = 'ipcr_system';
$user = 'root';        // change if needed
$pass = '';            // change if needed

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die('Database connection failed.');
}
?>