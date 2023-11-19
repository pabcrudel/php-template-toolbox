<?php
function setConnection($dbName) {
  // Database connection data:
  $server = "127.0.0.1"; // "localhost"
  $username = "root"; // Admin user for MySQL
  $password = ""; // Admin user password for MySQL
  
  // Try to connect to MySQL. Stops the script if there is an error.
  $connection = mysqli_connect($server, $username, $password);
  if (!$connection) {
    die("ERROR: Can not connect to \"$server\"<br>\n");
  }
  
  // Create DB if not exists
  $result = mysqli_query($connection,
    "CREATE DATABASE IF NOT EXISTS $dbName");
  
  // Selecting the database. Stops the script if there is an error.
  $result = mysqli_select_db($connection, $dbName);
  if (!$result) {
    die("ERROR: Can not select the database \"$dbName\"<br>");
  }

  return $connection;
}
?>