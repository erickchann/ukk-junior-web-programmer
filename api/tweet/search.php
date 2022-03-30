<?php
  $conn = mysqli_connect('localhost', 'root', '', 'ukk');

  $key = $_GET['key'];

  $tweets = runQuery("SELECT * FROM tweets WHERE tags LIKE '%$key%'");
  
  echo json_encode($tweets);

  /**
   * Function untuk menjalankan query dan mereturnkan hasil query dalam bentuk array
   */
  function runQuery($query) {
    global $conn;

    $query = mysqli_query($conn, $query);
    $result = [];

    while ($row = mysqli_fetch_assoc($query)) {
      $row['tags'] = getTags($row['tags']);
      $row['comments'] = getComment($row['id']);
      $result[] = $row;
    }

    return $result;
  }

  /**
   * Function untuk mengambil tag berdasarkan id tweet yang dikirimkan
   */
  function getTags($id) {
    return explode(',', $id);
  }

  /**
   * Function untuk mengambil comment berdasarkan id tweet yang dikirim
   */
  function getComment($id) {
    global $conn;
  
    $query = mysqli_query($conn, "SELECT * FROM comments WHERE tweet_id = '$id'");
    $result = [];

    while ($row = mysqli_fetch_assoc($query)) {
      $row['tags'] = getCommentTags($row['tags']);
      $result[] = $row;
    }
  
    return $result;
  }

  /**
   * Function untuk mengambil tag dari comment
   */
  function getCommentTags($id) {
    return explode(',', $id);
  }