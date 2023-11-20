<?php
function executeQuery($connection, $query, $table) {
  $result = mysqli_query($connection, $query);
  if (!$result) {
    die("ERROR: Can not execute query on \"$table\"<br>\n");
  }

  return $result;
}
?>