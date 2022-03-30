<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="style/style.css">
  <link rel="stylesheet" href="style/login.css">
  <title>Register</title>
</head>
<body>
  <div class="container d-flex justify-content-center align-items-center">
    <form action="">
      <h4 class="text-center mb-4">Register</h4>
      <div class="form-floating mb-3">
        <input type="email" class="form-control" id="name" placeholder="name@xyz.com">
        <label for="name">Name</label>
      </div>
      <div class="form-floating mb-3">
        <input type="email" class="form-control" id="email" placeholder="name@xyz.com">
        <label for="email">Email address</label>
      </div>
      <div class="form-floating">
        <input type="password" class="form-control" id="password" placeholder="Password">
        <label for="password">Password</label>
      </div>

      <button type="button" class="btn btn-primary form-control mt-3" onclick="register()">Register</button>

      <p class="mt-2 text-center">Have an account? <a href="index.php">Login</a></p>
    </form>
  </div>
  <script>

    /**
     * Function untuk register yang akan mengrequest ke api register
     */
    function register() {
      const name = document.querySelector('#name').value;
      const email = document.querySelector('#email').value;
      const password = document.querySelector('#password').value;

      let data = {
        name,
        email,
        password
      };

      fetch(`api/auth/register.php`, {
        method: 'POST',
        body: JSON.stringify(data)
      })
        .then(res => res.json())
        .then(res => {
          if (res.message == 'Register Success') {
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