<?php
function executeQuery($connection, $query, $target) {
  $result = mysqli_query($connection, $query);
  if (!$result) {
    die("ERROR: Can not execute query on \"$target\"<br>\n");
  }

  return $result;
}
?>