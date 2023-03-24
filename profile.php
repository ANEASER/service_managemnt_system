<html>
<head>
<link rel="stylesheet" href="./styles/mainstyles.css">
  <style>
    .Gigs{
      display:flex;
      flex-direction:row;
    }  

    th, td{
      padding:2px 45px 2px 0px;
      text-align:center;
    }

    button {
        background-color: #4CAF50;
        border: none;
        color: #FFF;
        padding: 6px 14px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 14px;
        font-weight: bold;
        border-radius: 5px;
        cursor: pointer;
    }

    button:hover {
        background-color: #3e8e41;
    }

    input[type="submit"] {
    background-color: #4CAF50;
    color: #FFF;
    border-radius: 5px;
    border: none;
    padding: 10px 20px;
    cursor: pointer;
    margin-top: 10px;
  }

  table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
    marging-left: 5%;
  }

  th, td {
    padding: 8px;
    text-align: left;
    border: 1px solid black;
    background-color: #f2f2f2;
  }

  th {
    background-color: #f2f2f2;
    color: #444;
    font-weight: bold;
  }

  </style>
</head>
<body style="background-image:url('./styles/background.jpg'); ">
  <nav>
      <a class="navitem" href="market/market.php">Market</a>
      <a class="navitem" href="postgig.php">Post a GIG</a>
      <a class="navitem" href="help.php">Help !</a>
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

<div class="profile" style="display:flex; flex-direction:row; margin: 2% 0% 2% 0%; ">

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
      echo '<img src="uploads/default.jpg" style="height: 200px; margin:5%" >';
    }
  ?>
  </div>
  
  <div style="margin-left:5%; padding:0 5% 0 5%; width:100%">

    <p style="color:darkgreen; font-weight:900; font-size:25px;"><?php echo $row['username']; ?></p>
    <p><?php echo $row['email']; ?></p>
    <p>Wallet   <?php echo $row['amount']; ?> <button> withdraw </button> </p><br>
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

echo'<div class="Gigs" style="display:flex; flex-direction:row;flex-wrap:wrap ">';
// Loop through the results and display the information for each user
while ($row = mysqli_fetch_array($result_3)) {
  echo '<div style="margin : 1% ;padding:2%;background-color:lightgreen;color:green">';
  echo "<p>ID: " . $row['id'] . "</p>";
  echo "<p>Service: " . $row['gig_name'] . "</p>";
  echo "<p>Price: " . $row['price'] . "</p>";
  echo "<form method='post' action=''>
          <input type='hidden' name='id' value='" . $row['id'] . "'>
          <input style='background-color: red' type='submit' name='delete' value='Delete'>
        </form>";
  echo '</div>';
} //

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

echo '<div style="display:flex; flex-direction:row; margin:1%; background-color:lightgreen; padding-left: 5%">';
echo '<div>';
if (mysqli_num_rows($result_1) > 0) {
  echo "<p style='text-align:center'>Buying<p>";
  echo "<table>";
  echo "<tr>";
  echo "<th>Refference ID</th>";
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
   echo "";
}
echo '</div>';

echo '<div style="margin-left:5%">';
if (mysqli_num_rows($result_2) > 0) {
  echo "<p  style='text-align:center'>Selling<p>";
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
   echo "";
}
echo '</div>';
echo '</div>';



?>

</body>
</html>
