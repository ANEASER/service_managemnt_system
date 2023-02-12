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
      $service_1 = $_POST['service_1'];
      $service_2 = $_POST['service_2'];
      $service_3 = $_POST['service_3'];
    
      // Create the SQL statement to update the user's information
      $sql = "UPDATE users SET service_1 = '$service_1', service_2 = '$service_2', service_3 = '$service_3', username='$new_name', email='$email' WHERE username = '$name'";
    
      // Execute the statement
      $result = mysqli_query($conn, $sql);
    
      // Check if the update was successful
      if ($result) {
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
  <label for="select_1">Select an option:</label>
    <select id="select_1" name="service_1">
      <option value="None">None</option>
      <option value="Content Writing">Content Writing</option>
      <option value="Web Development">Web Development</option>
      <option value="Media Design">Media Design</option>
    </select><br>
    <label for="select_2">Select an option:</label>
    <select id="select_2" name="service_2">
      <option value="None">None</option>
      <option value="Content Writing">Content Writing</option>
      <option value="Web Development">Web Development</option>
      <option value="Media Design">Media Design</option>
    </select><br>
    <label for="select_3">Select an option:</label>
    <select id="select_3" name="service_3">
      <option value="None">None</option>
      <option value="Content Writing">Content Writing</option>
      <option value="Web Development">Web Development</option>
      <option value="Media Design">Media Design</option>
    </select><br>
    <input type="submit" name="submit" value="Update">
</form>

<script>
  const selectElements = document.querySelectorAll("select");

  selectElements.forEach(select => {
    select.addEventListener("change", function() {
      const selectedValue = this.value;
      selectElements.forEach(otherSelect => {
        if (otherSelect !== this) {
          otherSelect.querySelector(`[value="${selectedValue}"] && value != "None"`).disabled = true;
        }
      });
    });
  });
</script>

<a href="logout.php">Logout</a>

