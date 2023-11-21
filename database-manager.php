<?php
// Importing my libraries
require_once "database/create-database.php";
require_once "database/drop-database.php";
require_once "database/set-connection.php";
require_once "database/execute-query.php";

// Define the structure of the tables and the data to insert
$tables = [
  "administrators" => [
    "structure" => [
      "user VARCHAR(20) PRIMARY KEY NOT NULL",
      "key VARCHAR(20) NOT NULL"
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
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Database manager</title>
</head>

<body>
  <h1>Database manager</h1>
  <p>What do you want to do?</p>
  <form method="post" action="">
    <button type="submit" name="create">Create</button>
    <button type="submit" name="delete">Delete</button>
    <button type="submit" name="reset">Reset</button>
  </form>
  <hr>

  <?php
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['create'])) {
      echo "<h2>Creating database...</h2>";
      createDatabase($dbName, $tables);
    } elseif (isset($_POST['delete'])) {
      echo "<h2>Deleting database...</h2>";
      dropDatabase($dbName);
    } elseif (isset($_POST['reset'])) {
      echo "<h2>Resetting database...</h2>";
      echo "<h3>Deleting...</h3>";
      dropDatabase($dbName);
      echo "<h3>Creating...</h3>";
      createDatabase($dbName, $tables);
    }
  }
  ?>
</body>

</html>