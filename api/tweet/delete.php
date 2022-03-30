<?php
  session_start();

  $conn = mysqli_connect('localhost', 'root', '', 'ukk');

  $id = $_GET['id'];

  mysqli_query($conn, "DELETE FROM tweets WHERE id = '$id'");

  echo json_encode(['message' => 'Success']);