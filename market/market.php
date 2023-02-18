<?php

// Connect to the database
include '../db_connect.php';

// Start a session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
  header('Location: ../login.php');
}

// Get the username of the currently logged in user
$current_user = $_SESSION['username'];

// Create the SQL statement
$sql = "SELECT * FROM users WHERE username != '$current_user'";

// Execute the statement
$result = mysqli_query($conn, $sql);

echo'<div class="Gigs">';
// Loop through the results and display the information for each user
while ($row = mysqli_fetch_array($result)) {
  echo'<div>';
  echo "<p>Username: " . $row['username'] . "</p>";
  echo "<p>Service-1: " . $row['service_1'] . "</p>";
  echo "<p>Service-2: " . $row['service_2'] . "</p>";
  echo "<p>Service-3: " . $row['service_3'] . "</p>";
  echo "<p>Price: " . $row['price'] . "</p>";
  echo "<form action='hire.php' method='post'>";
  echo "<input type='hidden' name='seller_username' value='" . $row['username'] . "'>";
  echo "<input type='submit' value='Hire'>";
  echo "</form>";
  echo'</div>';
}

echo'</div>';
// Close the connection
mysqli_close($conn);

?>

<style>
   .Gigs {
    display:flex; flex-direction:row; justify-content:space-between;
   }
</style>