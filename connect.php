<?php
$servername = "127.0.0.1";
$username = "php";
$password = "123";

// Create connection
$conn = new mysqli($servername, $username, $password, "Company_Payroll");

// Check connection
if (!$conn)
{
    die("Connection failed: " . mysqli_connect_error());
}
//echo "Connected successfully";
?> 