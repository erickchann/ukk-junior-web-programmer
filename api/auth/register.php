<?php
  session_start();

  $conn = mysqli_connect('localhost', 'root', '', 'ukk');

  $data = json_decode(file_get_contents('php://input'));

  $queryUser = mysqli_query($conn, "SELECT * FROM users WHERE email = '$data->email' LIMIT 1");
  $resultUser = mysqli_fetch_assoc($queryUser);

  if (mysqli_num_rows($queryUser) != 0) {
    echo json_encode(['message' => 'Username Already Registered']);
  } else {
    $password = password_hash($data->password, PASSWORD_BCRYPT);
    $queryCreateUser = mysqli_query($conn, "INSERT INTO users (name, email, password) VALUES ('$data->name', '$data->email', '$password')");
    
    // Get user data
    $queryUser2 = mysqli_query($conn, "SELECT * FROM users WHERE email = '$data->email' LIMIT 1");
    $resultUser2 = mysqli_fetch_assoc($queryUser2);

    $_SESSION['email'] = $data->email;
    $_SESSION['auth'] = true;
      
    echo json_encode(['message' => 'Register Success', 'user_id' => $resultUser2['id']]);
  }