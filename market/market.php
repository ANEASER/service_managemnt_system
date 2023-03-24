<html>
<head>
  <link rel="stylesheet" href="../styles/mainstyles.css">
  <style>
   
    .Gigs{
      display:flex;
      flex-direction:row;
      font-weight:bolder;
    }  

    input[type="submit"] {
    background-color: #4CAF50;
    color:white;
    border-radius: 5px;
    border: none;
    padding: 10px 20px;
    cursor: pointer;
    margin-top: 10px;
    font-weight: bolder;
  }

  </style>
</head>
<body style="background-image:url('../styles/background.jpg')">
  <nav>
  <a class="navitem" href="../profile.php">Profile</a>
  <a class="navitem" href="../postgig.php">Post a GIG</a>
  </nav>

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
$sql = "SELECT * FROM gigs WHERE username != '$current_user'";

// Execute the statement
$result = mysqli_query($conn, $sql);

echo'<div class="Gigs" style="background-color: rgba(204, 204, 204, 0.418); padding:3%;justify-content: flex-start;border-radius:5px;flex-wrap:wrap">';
// Loop through the results and display the information for each user
while ($row = mysqli_fetch_array($result)) {
  echo'<div style="background-color:green; padding:3%; color:white; margin-right:3%;border-radius:5px">';
  echo "<p>Provider: " . $row['username'] . "</p>";
  echo "<p>Service: " . $row['gig_name'] . "</p>";
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

</body>
</html>