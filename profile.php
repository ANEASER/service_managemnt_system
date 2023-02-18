<?php

include 'db_connect.php';
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
  header('Location: login.php');
}

// Get the user's information from the session
$username = $_SESSION['username'];


// Create the SQL statement to get the user's information
$sql_1 = "SELECT * FROM users WHERE username = '$username'";
$sql_2 = "SELECT * FROM transactions WHERE  buyer = '$username' ";
$sql_3 = "SELECT * FROM transactions WHERE  seller ='$username' ";

// Execute the statement
$result = mysqli_query($conn, $sql_1);
$row = mysqli_fetch_array($result);

$result_1 = mysqli_query($conn, $sql_2);
$result_2 = mysqli_query($conn, $sql_3);

if (mysqli_num_rows($result_1) > 0) {
  echo "Buying";
  echo "<table>";
  echo "<tr>";
  echo "<th>Ref_ID</th>";
  echo "<th>seller</th>";
  echo "<th>sale</th>";
  echo "</tr>";

  while ($row_1 = mysqli_fetch_array($result_1)) {
    echo "<tr>";
    echo "<td>".$row_1['id']."</td>";
    echo "<td>".$row_1['seller']."</td>";
    echo "<td>".$row_1['sale']."</td>";
    echo "</tr>";
  }

echo "</table>";
} else {
   echo "None";
}

if (mysqli_num_rows($result_2) > 0) {
  echo "Selling";
  echo "<table>";
  echo "<tr>";
  echo "<th>Ref_ID</th>";
  echo "<th>buyer</th>";
  echo "<th>sale</th>";
  echo "</tr>";

  while ($row_2 = mysqli_fetch_array($result_2)) {
    echo "<tr>";
    echo "<td>".$row_2['id']."</td>";
    echo "<td>".$row_2['buyer']."</td>";
    echo "<td>".$row_2['sale']."</td>";
    echo "</tr>";
  }

echo "</table>";
} else {
   echo "None";
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
<a href="market/market.php">Market</a>
<a href="out/logout.php">Logout</a>
<a href="out/deactivate.php">Deactivate</a>
</center>