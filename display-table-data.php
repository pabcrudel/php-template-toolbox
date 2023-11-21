<?php
// Importing my libraries
require_once "database/create-database.php";
require_once "database/drop-database.php";
require_once "database/set-connection.php";
require_once "database/execute-query.php";

// Set connection
$connection = setConnection("products");

// Execute query
$table = "articles";
$result = executeQuery($connection, "SELECT * FROM $table;", $table);

// Display how many items have been found
$founds = mysqli_num_rows($result);
echo "Query found $founds items:<br>";

// If there is any result
if ($founds > 0) {
  while ($fila = mysqli_fetch_assoc($result)) {
    // Date must be parsed
    $registrationDate = new DateTime($fila['registration_date']);

    // Format date: format('Y-m-d H:i:s');
    $formattedDate = $registrationDate->format('Y-m-d');

    $id = $fila['id'];
    echo "<hr>";
    echo "<div>".
      "<b>Id:</b> $id".
      " <b>Name:</b> ". $fila['name'].
      " <b>Registration date:</b> $formattedDate".
      " <b>Price:</b> ". $fila['price'].
      " </div>";
    echo "<div><b>Description:</b></div>";
    echo nl2br($fila['description']);
  }
  echo "<hr>";
}

// Close connection when the script finish
mysqli_close($connection);
?>