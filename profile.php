<html></html>
<?php

// Connect to the database
include 'db_connect.php';

// Start a session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
  header('Location: login.php');
}

// Get the user's information from the session
$username = $_SESSION['username'];


// Create the SQL statement to get the user's information
$sql_1 = "SELECT * FROM users WHERE username = '$username'";
$sql_2 = "SELECT * FROM transactions WHERE  buyer = '$username' or seller ='$username' ";

// Execute the statement
$result = mysqli_query($conn, $sql_1);
$row = mysqli_fetch_array($result);

$result_1 = mysqli_query($conn, $sql_2);
$rows = mysqli_num_rows($result_1);


if (mysqli_num_rows($result_1) > 0) {
  while ($row_1 = mysqli_fetch_array($result_1)) {
    echo "<p>id : " . $row_1['id'] . "</p>";
    echo "<p>seller: " . $row_1['seller'] . "</p>";
    echo "<p>buyer: " . $row_1['buyer'] . "</p>";
    echo "<p>Sale: " . $row_1['sale'] . "</p>";
    echo "-----------------------------------------------";
  }
} else {
  //echo "$rows"." transactions found.";
}

?>
<center>
<p style="color:red">Username: <?php echo $row['username']; ?></p>
<p>Email: <?php echo $row['email']; ?></p>
<p>Service-1 <?php echo $row['service_1']; ?></p>
<p>Service-2 <?php echo $row['service_2']; ?></p>
<p>Service-3 <?php echo $row['service_3']; ?></p>
<p>Wallet <?php echo $row['amount']; ?></p>
<a href="update.php">Update Services</a>
<br>
<a href="market.php">Market</a>
<a href="logout.php">Logout</a>
</center>