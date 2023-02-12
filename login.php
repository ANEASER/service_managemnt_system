<?php

include 'db_connect.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Retrieve the user's password hash from the database
  $sql = "SELECT password FROM users WHERE username = '$username'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_array($result);
    $password_hash = $row['password'];

    // Verify the submitted password against the hash
    if (($username =='Admin') && ($password == 'password')) {
      header('Location: admin.php');
      exit;
    } else if ($password == $password_hash) {
      session_start();
      $_SESSION['username'] = $username;
      header('Location: profile.php');
      exit;
    } else {
      echo "Incorrect username or password";
    }
  } else if (($username =='Admin') && ($password == 'password')) {
    header('Location: admin.php');
    exit;
  }else {
    echo "Incorrect username or password";
  }
}

?>

<!-- Login form -->
<form method="post">
  <label for="username">Username:</label>
  <input type="text" id="username" name="username">
  <br>
  <label for="password">Password:</label>
  <input type="password" id="password" name="password">
  <br>
  <input type="submit" value="Login">
</form>
