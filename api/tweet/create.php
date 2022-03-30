<?php
  session_start();

  $conn = mysqli_connect('localhost', 'root', '', 'ukk');

  $data = json_decode(file_get_contents('php://input'));

  $arrayData = explode('#', $data->content);

  $email = $_SESSION['email'];
  $queryUser = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email' LIMIT 1");
  $resultUser = mysqli_fetch_assoc($queryUser);

  $arrayOfTags = array_slice($arrayData, 1, count($arrayData) - 1);

  $tags = implode(',', $arrayOfTags);
  $queryInsertTweet = mysqli_query($conn, "INSERT INTO tweets (content, user_id, tags) VALUES ('$arrayData[0]', {$resultUser['id']}, '$tags')");
  $id = mysqli_insert_id($conn);
  
  foreach ($arrayData as $key => $value) {
    if ($key != 0) {
      if (isNotDuplicate($value)) {
        mysqli_query($conn, "INSERT INTO tags (title) VALUES ('$value')");
      }
    }
  }

  /**
   * Function untuk melihat apakah tag diplicate atau tidak
   */
  function isNotDuplicate($value) {
    global $conn;

    $query = mysqli_query($conn, "SELECT * FROM tags WHERE title = '$value'");

    if (mysqli_num_rows($query) == 0) {
      return true;
    } else {
      return false;
    }
  }