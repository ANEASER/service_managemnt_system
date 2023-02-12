<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

date_default_timezone_set('Asia/Kolkata');

include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password']; //if this hashed this won't work
  $service_1= $_POST["service_1"];
  $service_2 = $_POST["service_2"];
  $service_3 = $_POST["service_3"];
  $amount =  0;
  $price = $_POST["price"];

  // Check if the username already exists
  $sql = "SELECT username FROM users WHERE username = '$username'";
  $result = mysqli_query($conn, $sql);
  $num_rows = mysqli_num_rows($result);
  
  if ($num_rows > 0) {
    echo "Error: The username is already taken";
  }

  // Prepare the INSERT statement
  $stmt = mysqli_prepare($conn, "INSERT INTO users (username, email, password,service_1,service_2,service_3,amount,price) VALUES (?, ?, ?, ? ,?, ?, ?,?)");
  mysqli_stmt_bind_param($stmt, 'ssssssss', $username, $email, $password,$service_1,$service_2,$service_3,$amount,$price); // ssss mean number of varables


  // Execute the statement
 
  if (mysqli_stmt_execute($stmt)) {
    header('Location: login.php');
    exit;
    } else {
    echo "Error: " . mysqli_stmt_error($stmt);
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
  <label for="price">Your Price</label>
  <input type="number" name="price" min="0" max="30"> <br>
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





