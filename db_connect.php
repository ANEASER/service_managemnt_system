<?php
$conn = mysqli_connect('localhost', 'root', '', 'servicemanagement');

// Check for errors
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
?>