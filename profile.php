<?php
  require 'middleware.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="style/style.css">
  <link rel="stylesheet" href="style/profile.css">
  <title>Profile</title>

  <style>

    .custom-modal {
      width: 500px;
      height: 400px;
    }

  </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="home.php">PT. XYZ</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="home.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="profile.php">Profile</a>
          </li>
        </ul>
        <a href="logout.php">Logout</a>
      </div>
    </div>
  </nav>
  
  <main class="container">
    <div class="img-container mb-3">
      <img src="profiles/noprofile.jpg" alt="Profile" id="user-image">
    </div>
    <p class="bio text-center" id="user-bio"></p>
  </main>

  <button type="button" class="btn btn-primary fab" onclick="openModal()">Edit</button>

  <div class="modal-overlay" id="modalOverlay"></div>
  <div class="custom-modal" id="modal">
    <div class="container mt-5">
      <div class="mb-3">
        <label for="image" class="form-label">Image</label>
        <input class="form-control" type="file" id="image">
      </div>
      <div class="form-floating">
        <textarea class="form-control" id="bio" style="height: 100px"></textarea>
        <label for="bio">Bio</label>
      </div>
    </div>

    <div class="modal-footer">
      <div>
        <button type="button" class="btn btn-danger" onclick="closeModal()">Close</button>
        <button type="button" class="btn btn-primary" onclick="saveProfile()">Save</button>
      </div>
    </div>
  </div>

  <script>
    // Menjalankan function untuk megambil data user ketika document di load
    window.onload = fetchUserData();

    /**
     * Function untuk merequest data user dan menampilkannya
     */
    function fetchUserData() {
      const userBio = document.querySelector('#user-bio');
      const userImage = document.querySelector('#user-image');

      fetch(`api/user/show.php`)
        .then(res => res.json())
        .then(res => {
          if (res.image) {
            userImage.src = `profiles/${res.image}`;
          }

          userBio.innerHTML = res.bio || 'Belum Ada Bio';
        })
    }

    /**
     * Function untuk mengsave biodata
     */
    function saveProfile() {
      const file = document.querySelector('#image').files[0];
      const bio = document.querySelector('#bio').value;

      // Hanya izinkan .jpg dan .png
      if(!['image/jpeg', 'image/png'].includes(file.type)) {
        alert('Only accept .jpeg and .png');
        
        return;
      }
      
      // Maksimal 2mb
      if (file.size > 2 * 1024 * 1024) {
        alert('File size to big');
        
        return;
      }

      const formData = new FormData();
      
      formData.append('image', file);
      formData.append('bio', bio);

      fetch('api/user/edit.php', {
        method: 'POST',
        body: formData
      })
      .then(res => res.text())
      .then(data => {
        document.querySelector('#image').value = '';
        document.querySelector('#bio').value = '';

        closeModal();
        fetchUserData();
      });
    }

    /**
     * Function untuk membuka modal untuk mengedit biodata
     */
    function openModal() {
      const modalOverlay = document.querySelector('#modalOverlay');
      const modal = document.querySelector('#modal');

      modalOverlay.classList.add('open');
      modal.classList.add('open');
    }
    
    /**
     * Function untuk menutup modal edit
     */
    function closeModal() {
      const modalOverlay = document.querySelector('#modalOverlay');
      const modal = document.querySelector('#modal');

      modalOverlay.classList.remove('open');
      modal.classList.remove('open');
    }

  </script>
</body>

</html>