<?php
    include 'db_connect.php';

    // Start a session
    session_start();
    
    // Check if the user is logged in
    if (!isset($_SESSION['username'])) {
      header('Location: login.php');
    }

    echo "This is admin";

    $name = $_POST['name'];

    if (isset($_POST['submit'])) {
      // Get the updated service information from the form
      $new_name = $_POST['username'];
      $email = $_POST['email'];
    
      // Create the SQL statement to update the user's information
      $sql = "UPDATE users SET  username='$new_name', email='$email' WHERE username = '$name'";
      $sql_1 = "UPDATE gigs SET  username='$new_name' WHERE username = '$name'";
      // Execute the statement
      $result = mysqli_query($conn, $sql);
      $result_1 = mysqli_query($conn, $sql_1);
      // Check if the update was successful
      if ($result && $result_1) {
        echo "<script>alert('Service information updated successfully!');</script>";
        header('Location: admin.php');
      } else {
        echo "<script>alert('Error updating service information: " . mysqli_error($conn) . "');</script>";
      }
    
      // Close the connection
      mysqli_close($conn);}
    
?>

<form method="post" action="">

  <label for="username">Search name:</label>
     <input type="text" id="name" name="name">
  <br>
  <p>Update Data</p><br>
  <label for="username">Username:</label>
  <input type="text" id="username" name="username">
  <br>
  <label for="email">Email:</label>
  <input type="email" id="email" name="email">
  <br>
  <input type="submit" name="submit" value="Update">
</form>

<a href="account_settings/logout.php">Logout</a>

