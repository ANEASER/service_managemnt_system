<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

date_default_timezone_set('Asia/Kolkata');

include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password']; //if this hashed this won't work
  $password_1 = $_POST['password_1'];
  $amount =  0;

  // Check if the username already exists
  $sql = "SELECT username FROM users WHERE username = '$username'";
  $result = mysqli_query($conn, $sql);
  $num_rows = mysqli_num_rows($result);
  
  if ($num_rows > 0) {
    echo "Error: The username is already taken";
  }

  elseif( $password != $password_1){
    echo "Passwords not match";
  }

  else {
  // Prepare the INSERT statement
  $stmt = mysqli_prepare($conn, "INSERT INTO users (username, email, password,amount) VALUES (?, ?, ?, ?)");
  mysqli_stmt_bind_param($stmt, 'ssss', $username, $email, $password,$amount); // ssss mean number of varables
  // Execute the statement
 
  if (mysqli_stmt_execute($stmt)) {
    header('Location: login.php');
    exit;
    } else {
    echo "Error: " . mysqli_stmt_error($stmt);
  }
  }
}
?>

<!-- Create user form -->
<form method="post">
  <label for="username">Username:</label>
  <input type="text" id="username" name="username">
  <br>
  <label for="email">Email:</label>
  <input type="email" id="email" name="email">
  <br>
  <label for="password">Password:</label>
  <input type="password" id="password" name="password">
  <br>
  <label for="password">Enter Password again:</label>
  <input type="password" id="password" name="password_1">
  <br>
  <input type="submit" value="Create User">
</form>


<script>
  const selectElements = document.querySelectorAll("select");

  selectElements.forEach(select => {
    select.addEventListener("change", function() {
      const selectedValue = this.value;
      selectElements.forEach(otherSelect => {
        if (otherSelect !== this) {
          otherSelect.querySelector(`[value="${selectedValue}"]`).disabled = true;
        }
      });
    });
  });
</script>





