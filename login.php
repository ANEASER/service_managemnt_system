<html>
<head>
 <title>Servie Online</title>
 <link rel="stylesheet" href="./styles/login_create_styles.css">
</head>
<body style="background-image:url('./styles/background.jpg')">
<?php

include 'db_connect.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Retrieve the user's password hash from the database
  $sql = "SELECT * FROM users WHERE username = '$username'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_array($result);
    $password_hash = $row['password'];
    $role = $row['role'];

    // Verify the submitted password against the hash
    if (($role =='admin') && ($password == $password_hash)) {
      session_start();
      $_SESSION['username'] = $username;
      header('Location: admin.php');
    } else if (($role =='') && ($password == $password_hash)) {
      session_start();
      $_SESSION['username'] = $username;
      header('Location: profile.php');
    } else {
      echo "Incorrect username or password";
    }
   }else {
    echo "Incorrect username or password";
  }
}

?>

<center>
<form method="post">
  <label for="username">Username:</label>
  <input type="text" id="username" name="username">
  <br>
  <label for="password">Password:</label>
  <input type="password" id="password" name="password">
  <br>
  <input type="submit" value="Login"><br>
</form>
<p>Haven't an account?</p>
<a href="create_user.php">Register</a>
</center>

</body>
</html>