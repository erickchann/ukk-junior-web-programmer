<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="style/style.css">
  <link rel="stylesheet" href="style/login.css">
  <title>Login</title>
</head>
<body>
  <div class="container d-flex justify-content-center align-items-center">
    <form action="">
      <h4 class="text-center mb-4">Login</h4>
      <div class="form-floating mb-3">
        <input type="email" class="form-control" id="email" placeholder="name@xyz.com">
        <label for="email">Email address</label>
      </div>
      <div class="form-floating">
        <input type="password" class="form-control" id="password" placeholder="Password">
        <label for="password">Password</label>
      </div>

      <button type="button" class="btn btn-primary form-control mt-3" onclick="login()">Login</button>

      <p class="mt-2 text-center">Don't have account? <a href="register.php">Register</a></p>
    </form>
  </div>
  <script>

    /**
     * Function untuk login yang akan mengrequest ke api login
     */
    function login() {
      const email = document.querySelector('#email').value;
      const password = document.querySelector('#password').value;

      let data = {
        email,
        password
      };

      fetch(`api/auth/login.php`, {
        method: 'POST',
        body: JSON.stringify(data)
      })
        .then(res => res.json())
        .then(res => {
          if (res.message == 'Login Success') {
            localStorage.setItem('user_id', res.user_id);

            location.href = 'home.php';
          } else {
            alert(res.message);
          }
        });
    }

  </script>
</body>
</html>