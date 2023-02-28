<?php

    session_start();
    $username = $_SESSION['username'];

    echo $username;
 
  if (isset($_POST['submit'])) {
  
    if (isset($_FILES['image'])) {
    
      $file_name = $_FILES['image']['name'];
      $file_size = $_FILES['image']['size'];
      $file_tmp = $_FILES['image']['tmp_name'];
      $file_type = $_FILES['image']['type'];
      
      $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
      
      $upload_dir = "../uploads/";
      
      $new_file_name = $username . "." . $file_ext;
      
      if ($file_size <= 2097152) {
        // Check if the file is a valid image file (in this case, JPEG, PNG, or GIF)
        if (in_array($file_ext, array("jpg", "jpeg", "png", "gif"))) {
          // Move the uploaded file to the specified directory
          if (move_uploaded_file($file_tmp, $upload_dir . $new_file_name)) {
            echo "File uploaded successfully.";
          } else {
            echo "Error uploading file.";
          }
        } else {
          echo "Only JPEG, PNG, and GIF files are allowed.";
        }
      } else {
        echo "File size must be less than or equal to 2MB.";
      }
    } else {
      echo "No file selected.";
    }
  }
?>
