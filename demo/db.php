<?php
$servername = "localhost";
$username = "root";
$password = "";   // Your MySQL password, leave empty if none
$dbname = "employee_db";

$conn = new mysqli("localhost", "root", "", "employee_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>