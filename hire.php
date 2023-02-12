<?php

// Connect to the database
include 'db_connect.php';

// Start a session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
  header('Location: login.php');
}

// Get the username of the currently logged in user (buyer)
$buyer_username = $_SESSION['username'];

// Get the username of the seller from the form data
$seller_username = $_POST['seller_username'];

// Get the information for the seller
$seller_sql = "SELECT * FROM users WHERE username = '$seller_username'";
$seller_result = mysqli_query($conn, $seller_sql);
$seller = mysqli_fetch_array($seller_result);

$amount = $seller['price'];
$commision = $amount*0.25;
$amount = $amount*0.75;

// Create the SQL statement to increment the amount for the seller
$sql = "UPDATE users SET amount = amount + $amount WHERE username = '$seller_username'";

$sql_1 = mysqli_prepare($conn, "INSERT INTO transactions (buyer,seller,comision,sale) VALUES (?, ?, ?, ?)");
mysqli_stmt_bind_param($sql_1, 'ssss', $buyer_username, $seller_username,$commision,$amount+$commision );
mysqli_stmt_execute($sql_1);


// Execute the statement
$result = mysqli_query($conn, $sql);

// Get the information for the buyer
$buyer_sql = "SELECT * FROM users WHERE username = '$buyer_username'";
$buyer_result = mysqli_query($conn, $buyer_sql);
$buyer = mysqli_fetch_array($buyer_result);


// Close the connection
mysqli_close($conn);
header('Location: profile.php');
?>


