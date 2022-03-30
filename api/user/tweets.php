<?php
  session_start();

  $conn = mysqli_connect('localhost', 'root', '', 'ukk');

  $email = $_SESSION['email'];
  $queryUser = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email' LIMIT 1");
  $resultUser = mysqli_fetch_assoc($queryUser);

  $tweets = runQuery("SELECT * FROM tweets WHERE user_id = '{$resultUser['id']}'");

  echo json_encode($tweets);

  /**
   * Function untuk menjalankan query dan mereturnkan hasil query dalam bentuk array
   */
  function runQuery($query) {
    global $conn;

    $query = mysqli_query($conn, $query);
    $result = [];

    while ($row = mysqli_fetch_assoc($query)) {
      $row['tags'] = getTags($row['id']);
      $row['comments'] = getComment($row['id']);
      $result[] = $row;
    }

    return $result;
  }

  function getTags($id) {
    global $conn;
  
    $query = mysqli_query($conn, "SELECT * FROM tags WHERE tweet_id = '$id'");
    $result = [];

    while ($row = mysqli_fetch_assoc($query)) {
      $result[] = $row;
    }
  
    return $result;
  }

  function getComment($id) {
    global $conn;
  
    $query = mysqli_query($conn, "SELECT * FROM comments WHERE tweet_id = '$id'");
    $result = [];

    while ($row = mysqli_fetch_assoc($query)) {
      $result[] = $row;
    }
  
    return $result;
  }