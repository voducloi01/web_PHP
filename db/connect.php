<?php
$mysqli = new mysqli("localhost","root","","banlaptop");

// Check connection
if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}
mysqli_set_charset($mysqli,"utf8");

?>