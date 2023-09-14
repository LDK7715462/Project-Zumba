// To use on local machine, install XAMPP Control Panel and copy website files to
// C:\xampp\htdocs\dashboard after installation.
// Also make sure to setup mysql database with provided sql script.
<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "client_consessions";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
?>
