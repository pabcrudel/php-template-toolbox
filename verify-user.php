<?php
// Importing my libraries
require_once "database/set-connection.php";
require_once "database/execute-query.php";

$user = $_POST['user'];
$key = $_POST['key'];
if (isset($user) && !empty($user) && isset($key) && !empty($key)) {
  // Set connection
  $connection = setConnection("products");
  
  // Execute query
  $table = "administrators";
  $result = executeQuery(
    $connection,
    "SELECT * FROM $table WHERE (user='$user' and key='$key');",
    $table
  );

  echo "Query found $founds items:<br>";
  // If there is any result
  if (mysqli_num_rows($result) > 0) {
    $_SESSION['user'] = $user;
    $_SESSION['key'] = $key;
    $_SESSION['type'] = "admin";

    echo "<p>Welcome $user</p>";
  }
  else echo "<p>Unauthenticated user or incorrect key</p>";
}
else echo "Form data is not valid";
?>