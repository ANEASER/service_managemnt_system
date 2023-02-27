<html>
<head>
  <style>
    .Gigs{
      display:flex;
      flex-direction:row;
    }  
  </style>
</head>
<body>
  <nav style="dispaly:flex">
  <a href="market/market.php">Market</a>
  <a href="account_settings/logout.php">Logout</a>
  <a href="account_settings/deactivate.php">Deactivate</a>
  <a href="postgig.php">PostGIG</a>
  </nav>

  

<?php
  include 'db_connect.php';
  session_start();
  $username = $_SESSION['username'];

  $sql_5 = "SELECT * FROM users WHERE username = '$username'";
  $result_4 = mysqli_query($conn, $sql_5);
  $row = mysqli_fetch_array($result_4);

?>

<center>
  <p style="color:red">Username: <?php echo $row['username']; ?></p>
  <p>Email: <?php echo $row['email']; ?></p>
  <p>Wallet <?php echo $row['amount']; ?></p>
  <br>
  </center>


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

echo '<div style="display:flex; flex-direction:row;">';
echo '<div>';
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
echo '</div>';

echo '<div>';
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
echo '</div>';
echo '</div>';

$sql_4 = "SELECT * FROM gigs WHERE username = '$username'";

$result_3 = mysqli_query($conn, $sql_4);

echo'<div class="Gigs">';
// Loop through the results and display the information for each user
while ($row = mysqli_fetch_array($result_3)) {
  echo '<div>';
  echo "<p>ID: " . $row['id'] . "</p>";
  echo "<p>Username: " . $row['username'] . "</p>";
  echo "<p>Service: " . $row['gig_name'] . "</p>";
  echo "<p>Price: " . $row['price'] . "</p>";
  echo "<form method='post' action=''>
          <input type='hidden' name='id' value='" . $row['id'] . "'>
          <input type='submit' name='delete' value='Delete'>
        </form>";
  echo '</div>';
}

echo '</div>';

if (isset($_POST['delete'])) {
  $id = $_POST['id'];
  $delete_query = "DELETE FROM gigs WHERE id='$id'";
  mysqli_query($conn, $delete_query);
  header("Location: profile.php");
}

?>

</body>
</html>