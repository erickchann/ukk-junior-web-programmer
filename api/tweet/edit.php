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

  mysqli_query($conn, "UPDATE tweets SET content = '$arrayData[0]', tags = '$tags' WHERE id = '$data->id'");
  mysqli_query($conn, "DELETE FROM tags WHERE tweet_id = '$data->id'");

  foreach ($arrayData as $key => $value) {
    if ($key != 0) {
      if (isNotDuplicate($value)) {
        mysqli_query($conn, "INSERT INTO tags (title, tweet_id) VALUES ('$value', '$data->id')");
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