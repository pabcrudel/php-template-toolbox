<?php
// PHP file for the administrator to create the necessary database
// and tables with required fields.

// Importing my libraries
require_once "set-connection.php";
require_once "execute-query.php";

function createDatabase($dbName, $tables) {
  // Establish connection with MySQL
  echo "Connecting to the database \"$dbName\"...<br>\n";
  $connection = setConnection($dbName);
  echo "Connection with \"$dbName\" established.<br><br>\n";
  
  // Process each table
  foreach ($tables as $tableName => $tableInfo) {
    // Create Table
    echo "Creating the \"$tableName\" table...<br>\n";
    executeQuery(
      $connection,
      "CREATE TABLE IF NOT EXISTS $tableName"
      . "(" . implode(",", $tableInfo["structure"]) . ")",
      $tableName
    );
    echo "Table \"$tableName\" created.<br>\n";
  
    /*
    Process each "records" row:
    - Convert values, apply quotes, and treat 'NULL' as NULL
    */
    $records = []; // Reinitialize the array
    foreach ($tableInfo['records'] as $record) {
      $record = array_map(fn($value) =>
        ($value === null) ? 'NULL'
        : "'" . mysqli_real_escape_string($connection, $value) . "'", $record);
  
      $records[] = '(' . implode(',', $record) . ')';
    }
  
    // Insert data into the table
    echo "Inserting data into \"$tableName\"...<br>\n";
    executeQuery(
      $connection,
      "INSERT INTO $tableName VALUES " . implode(',', $records),
      $tableName
    );
    echo "Data added to \"$tableName\".<br><br>\n";
  }
  
  // Close the connection with the server
  echo "Closing the connection with the server...<br>\n";
  mysqli_close($connection);
  
  echo "End of the program.<br>\n";
}

// Define the structure of the tables and the data to insert
$tables = [
  "administrators" => [
    "structure" => [
      "user VARCHAR(20) PRIMARY KEY NOT NULL",
      "password VARCHAR(20) NOT NULL"
    ],
    "records" => [
      ["admin", "admin"],
    ],
  ],
  "articles" => [
    "structure" => [
      "id INT AUTO_INCREMENT PRIMARY KEY NOT NULL",
      "name VARCHAR(20) NOT NULL",
      "registration_date DATETIME NOT NULL",
      "price DECIMAL(6,2) NOT NULL",
      "description TEXT NOT NULL",
    ],
    "records" => [
      [null, "Cartridge", "2007-12-31", 6.50, "Black HP Cartridge"],
      [null, "Laser Printer", "2008-01-01", 120, "High capacity and speed"]
    ],
  ],
];

// Database name
$dbName = "products";

// How to call the database creation script
createDatabase($dbName, $tables);
?>
