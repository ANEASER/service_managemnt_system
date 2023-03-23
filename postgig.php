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
  </style>
  <link rel="stylesheet" href="./styles/login_create_styles.css">
</head>
<body style="background-image:url('./styles/background.jpg')">
  <nav style="dispaly:flex;padding:2%; color:white; background-color:green">
  <a class="navitem" href="market/market.php">Market</a>
  <a class="navitem" href="profile.php">Profile</a>
  </nav>

<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

date_default_timezone_set('Asia/Kolkata');

include 'db_connect.php';

session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
  }
  
  // Get the user's information from the session
$username = $_SESSION['username'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  //if this hashed this won't work
  $service = $_POST["service"];
  $price = $_POST["price"];
    
  // Prepare the INSERT statement
  $stmt = mysqli_prepare($conn, "INSERT INTO gigs (username,gig_name,price) VALUES (?, ?, ?)");
  mysqli_stmt_bind_param($stmt, 'sss',$username,$service,$price); // ssss mean number of varables


  // Execute the statement
 
  if (mysqli_stmt_execute($stmt)) {
    header('Location: profile.php');
    exit;
    } else {
    echo "Error: " . mysqli_stmt_error($stmt);
  }
}
?>
<div style="display:flex; justify-content:center">

<!-- Create user form -->
<form method="post">
  <label for="select_2">Select an option:</label>
  <select id="select_2" name="service">
    <option value="None">None</option>
    <option value="Content Writing">Content Writing</option>
    <option value="Web Development">Web Development</option>
    <option value="Media Design">Media Design</option>
  </select><br>
  <label for="price">Your Price</label>
  <input type="number" name="price" min="0" max="30"> <br>
  <input type="submit" value="POST">

</form>
</div>
</body>
</html>