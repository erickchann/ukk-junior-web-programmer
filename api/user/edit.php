<?php
  session_start();

  $conn = mysqli_connect('localhost', 'root', '', 'ukk');

  $email = $_SESSION['email'];

  if (isset($_POST['bio'])) {
    $bio = $_POST['bio'];

    runQuery("UPDATE users SET bio = '$bio' WHERE email = '$email'");
  }

  if (isset($_FILES['image'])) {
    $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
  
    $new_name = time() . '.' . $extension;

    move_uploaded_file($_FILES['image']['tmp_name'], '../../profiles/' . $new_name);
    
    runQuery("UPDATE users SET image = '$new_name' WHERE email = '$email'");
  }

  /**
   * Function untuk menjalankan query
   */
  function runQuery($query) {
    global $conn;

    $query = mysqli_query($conn, $query);
  }
  