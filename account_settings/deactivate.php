<?php 
    include '../db_connect.php';

    session_start();
    if (!isset($_SESSION['username'])) {
        header('Location: ../login.php');
      }
      
    
    $current_user = $_SESSION['username'];
    // Unset all of the session variables

    $sql = "DELETE FROM users WHERE username = '$current_user' ";
    mysqli_query($conn, $sql);

    $sql_1 = "DELETE FROM gigs WHERE username = '$current_user' ";
    mysqli_query($conn, $sql_1);

    $_SESSION = array();
    
    // Destroy the session
    session_destroy();

    echo "deactivated";
    
    // Redirect the user to the login page
    header('Location: ../login.php');
    exit;
?>