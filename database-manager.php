<?php
// Importing my libraries
require_once "set-connection.php";
require_once "execute-query.php";

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