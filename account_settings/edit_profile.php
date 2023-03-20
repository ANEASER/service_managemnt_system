<html>
<head>
 <title>Servie Online</title>
 <link rel="stylesheet" href="../styles/login_create_styles.css">
</head>
<body style="background-image:url('../styles/background.jpg')">

<?php
    include '../db_connect.php';

    // Start a session
    session_start();
    $username = $_SESSION['username'];

    echo '<p style="text-align:center;font-weight:bolder;color:green;font-size:26px">'.$username.'</p>';
    
    // Check if the user is logged in
    if (!isset($_SESSION['username'])) {
      header('Location: login.php');
    }

    
    if (isset($_POST['submit'])) {
      // Get the updated service information from the form
      $new_name = $_POST['username'];
      $email = $_POST['email'];
    
      // Create the SQL statement to update the user's information
      $sql = "UPDATE users SET  username='$new_name' WHERE username = '$username'";
      $sql_1 = "UPDATE gigs SET  username='$new_name' WHERE username = '$username'";
      $sql_2 = "UPDATE users SET email='$email' WHERE username = '$username'";
      // Execute the statement
      if (($new_name != NULL) && ($email == NULL)){
        $result = mysqli_query($conn, $sql);
        $result_1 = mysqli_query($conn, $sql_1);
        header('Location: ../login.php');
        }
      
      elseif(($new_name == NULL) && ($email != NULL)){
        $result_2 = mysqli_query($conn, $sql_2);
        header('Location: ../login.php');}

      
      else{
        $result = mysqli_query($conn, $sql);
        $result_1 = mysqli_query($conn, $sql_1);
        $result_2 = mysqli_query($conn, $sql_2);
        header('Location: ../login.php');
      }

      mysqli_close($conn);}
    
?>

<center>

<form method="post" action="">
  <label for="username">Username:</label>
  <input type="text" id="username" name="username">
  <br>
  <label for="email">Email:</label>
  <input type="email" id="email" name="email">
  <br>
  <input type="submit" name="submit" value="Update">
</form>

<form method="post" action="upload.php" enctype="multipart/form-data">
  <label for="image">Select an image to upload:</label>
  <input type="file" id="image" name="image">
  <br>
  <input type="submit" name="submit" value="Upload">
</form>

</center>

</body>
</html>

