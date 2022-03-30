<?php
  session_start();

  $conn = mysqli_connect('localhost', 'root', '', 'ukk');

  $email = $_SESSION['email'];
  $user = runQuery("SELECT * FROM users WHERE email = '$email' LIMIT 1")[0];
  
  echo json_encode($user);

  /**
   * Function untuk menjalankan query dan mereturnkan hasil query dalam bentuk array
   */
  function runQuery($query) {
    global $conn;

    $query = mysqli_query($conn, $query);
    $result = [];

    while ($row = mysqli_fetch_assoc($query)) {
      $result[] = $row;
    }

    return $result;
  }