<html>
<head>
  <style>
    .Gigs{
      display:flex;
      flex-direction:row;
    }  

    .navitem{
      margin : 0.5% 2% 0.5% 2%;
      text-decoration: none;
      color: inherit;
    }

    .navitem:hover {
      border: solid yellow 2px;
      padding:5px;
      border-radius:5px;
    }

    th, td{
      padding:2px 45px 2px 0px;
      text-align:center;
    }


  </style>
</head>
<body style="background-color: lightgreen">
  <nav style="dispaly:flex;padding:2%; color:white; background-color:green">
  <a class="navitem" href="market/market.php">Market</a>
  <a class="navitem" href="postgig.php">Post a GIG</a>
  <a class="navitem" href="account_settings/logout.php">Logout</a>
  <a class="navitem" href="account_settings/deactivate.php">Deactivate</a>
  </nav>

<?php
  include 'db_connect.php';
  session_start();
  $username = $_SESSION['username'];

  $sql_5 = "SELECT * FROM users WHERE username = '$username'";
  $result_4 = mysqli_query($conn, $sql_5);
  $row = mysqli_fetch_array($result_4);

?>

<div class="profile" style="display:flex; flex-direction:row; margin: 2% 0% 2% 0%; color:green">

  <div>
  <?php

    session_start();
    $username = $_SESSION['username'];
    $file_ext = "jpg";
    $image_dir = "uploads/";
    $image_path = $image_dir . $username . "." . $file_ext;
    if (file_exists($image_path)) {
      echo '<img src="' . $image_path . '" alt="' . $username . '" style="height: 200px;">';
    } else {
      echo '<img src="uploads/default.jpg" style="height: 200px;" >';
    }
  ?>
  </div>
  
  <div style="margin-left:5%">

    <p style="color:darkgreen; font-weight:900;"><?php echo $row['username']; ?></p>
    <p><?php echo $row['email']; ?></p>
    <p>WALLET <?php echo $row['amount']; ?> <button> withdraw </button> </p>
    <a class="navitem" style="color:darkgreen;font-weight:900" href="account_settings/edit_profile.php">Edit Profile</a>
    <br>

  </div>

</div>

<?php

include 'db_connect.php';
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
  header('Location: login.php');
}


// Get the user's information from the session
$username = $_SESSION['username'];

$sql_4 = "SELECT * FROM gigs WHERE username = '$username'";

$result_3 = mysqli_query($conn, $sql_4);

echo'<div class="Gigs" style="display:flex; flex-direction:row; border: solid 1px black; ">';
// Loop through the results and display the information for each user
while ($row = mysqli_fetch_array($result_3)) {
  echo '<div style="margin : 2%">';
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


// Create the SQL statement to get the user's information
$sql_1 = "SELECT * FROM users WHERE username = '$username'";
$sql_2 = "SELECT * FROM transactions WHERE  buyer = '$username' ";
$sql_3 = "SELECT * FROM transactions WHERE  seller ='$username' ";

// Execute the statement
$result = mysqli_query($conn, $sql_1);
$row = mysqli_fetch_array($result);

$result_1 = mysqli_query($conn, $sql_2);
$result_2 = mysqli_query($conn, $sql_3);

echo '<div style="display:flex; flex-direction:row; margin:5%">';
echo '<div>';
if (mysqli_num_rows($result_1) > 0) {
  echo "<p text-align:center>Buying<p>";
  echo "<table>";
  echo "<tr>";
  echo "<th>Ref_ID  </th>";
  echo "<th>seller  </th>";
  echo "<th>sale  </th>";
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
   echo "<p>None</p>";
}
echo '</div>';

echo '<div style="margin-left:5%">';
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
   echo "<p>None</p>";
}
echo '</div>';
echo '</div>';



?>

</body>
</html>