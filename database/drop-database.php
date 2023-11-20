<?php
// PHP file for the administrator to drop the database.

// Importing my libraries
require_once "set-connection.php";
require_once "execute-query.php";

function dropDatabase($dbName) {
  // Establish connection with MySQL
  echo "Connecting to the database \"$dbName\"...<br>\n";
  $connection = setConnection($dbName);
  echo "Connection with \"$dbName\" established.<br><br>\n";
  
  echo "Dropping the database \"$dbName\"...<br>\n";
  executeQuery($connection, "DROP DATABASE $dbName", $dbName);
  echo "Database \"$dbName\" dropped.<br>\n";
  
  // Close the connection with the server
  echo "Closing the connection with the server...<br>\n";
  mysqli_close($connection);
  
  echo "End of the program.<br>\n";
}
?>