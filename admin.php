<?php
    include 'db_connect.php';

    // Start a session
    session_start();
    
    // Check if the user is logged in
    if (!isset($_SESSION['username'])) {
      header('Location: login.php');
    }

    echo "This is admin";
    echo "<pre></pre>";

    $name = $_POST['name'];

    if (isset($_POST['submit'])) {
      // Get the updated service information from the form
      $new_name = $_POST['username'];
      $email = $_POST['email'];
    
      // Create the SQL statement to update the user's information
      $sql = "UPDATE users SET username='$new_name', email='$email' WHERE username = '$name'";
      $sql_1 = "UPDATE gigs SET username='$new_name' WHERE username = '$name'";
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
      mysqli_close($conn);
    }
    
    if (isset($_POST['delete'])) {
      // Get the name of the user to delete
      $name = $_POST['name'];
      
      // Create the SQL statement to delete the user
      $sql = "DELETE FROM users WHERE username = '$name'";
      $sql_1 = "DELETE FROM gigs WHERE username = '$name'";
      
      // Execute the statement
      $result = mysqli_query($conn, $sql);
      $result_1 = mysqli_query($conn, $sql_1);
      
      // Check if the deletion was successful
      if ($result && $result_1) {
        echo "<script>alert('User deleted successfully!');</script>";
        header('Location: admin.php');
      } else {
        echo "<script>alert('Error deleting user: " . mysqli_error($conn) . "');</script>";
      }
      
      // Close the connection
      mysqli_close($conn);
    }

    
?>

<form method="post" action="">
  <label for="name">Search name:</label>
  <input type="text" id="name" name="name">
  <br>
  <p>Update Data</p><br>
  <label for="username">Username:</label>
  <input type="text" id="username" name="username">
  <br>
  <label for="email">Email:</label>
  <input type="email" id="email" name="email">
  <br>
  <pre></pre>
  <input type="submit" name="submit" value="Update">
  <input type="submit" name="delete" value="Delete">
  <input type="submit" name="view" value="View">
</form>

<?php
  if (isset($_POST['view'])) {
    // Get the name of the user to view
    $name = $_POST['name'];
    
    // Create the SQL statement to retrieve the user's information
    $sql = "SELECT * FROM users WHERE username = '$name'";
    
    // Execute the statement
    $result = mysqli_query($conn, $sql);
    
    // Check if any rows were returned
    if (mysqli_num_rows($result) > 0) {
      // Fetch the data and display it
      $row = mysqli_fetch_assoc($result);
      echo "<br>";
      echo "Username: " . $row['username'] . "<br>";
      echo "Email: " . $row['email'] . "<br>";
      echo "Balance: " . $row['amount'] . "<br>";
      // You can display other relevant data here
    } else {
      echo "<script>alert('User not found!');</script>";
    }
    
    // Close the connection
    mysqli_close($conn);
  }
?>
<pre></pre>
<a href="account_settings/logout.php">Logout</a>
