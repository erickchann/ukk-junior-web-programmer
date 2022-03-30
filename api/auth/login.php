<?php
  session_start();

  $conn = mysqli_connect('localhost', 'root', '', 'ukk');

  $data = json_decode(file_get_contents('php://input'));

  $queryUser = mysqli_query($conn, "SELECT * FROM users WHERE email = '$data->email' LIMIT 1");
  $resultUser = mysqli_fetch_assoc($queryUser);

  if (mysqli_num_rows($queryUser) == 0) {
    echo json_encode(['message' => 'Invalid Login']);
  } else {
    if (password_verify($data->password, $resultUser['password'])) {
      $_SESSION['email'] = $resultUser['email'];
      $_SESSION['auth'] = true;
      
      echo json_encode(['message' => 'Login Success', 'user_id' => $resultUser['id']]);
    } else {
      echo json_encode(['message' => 'Invalid Login']);
    }
  }