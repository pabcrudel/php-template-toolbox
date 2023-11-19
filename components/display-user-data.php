<?php
// Displays user name, type and permissions
$userData = "Welcome: <b>". $_SESSION['user'].
  "</b> - User type: <b>" . $_SESSION['type'] . "</b>";

echo "<p>$userData</p>";

$userPermissions = ($_SESSION['user'] == "anonymous")
  ? "User not registered. Read-only permissions"
  : "User registered, Read and write permissions";

echo "<p>$userPermissions</p>";
?>