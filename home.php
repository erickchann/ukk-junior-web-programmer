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
  <title>Home</title>

  <style>

    .custom-modal {
      width: 500px;
      height: 350px;
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
            <a class="nav-link active" href="home.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="profile.php">Profile</a>
          </li>
        </ul>
        <a href="logout.php">Logout</a>
      </div>
    </div>
  </nav>

  <main class="container mt-2">
    <div class="d-flex">
      <input type="search" name="search" id="search" class="w-100">
      <button type="button" class="btn btn-primary" onclick="fetchSearch()">Search</button>
    </div>

    <div class="mt-4" id="tweet-container">
    </div>
  </main>

  <button type="button" class="btn btn-primary fab" onclick="openModal()">Create</button>

  <!-- Create Tweet Modal -->
  <div class="modal-overlay" id="modalOverlay"></div>
  <div class="custom-modal" id="modal">
    <div class="container mt-5">
      <div class="form-floating">
        <textarea class="form-control" id="content" style="height: 200px" maxlength="250"></textarea>
        <label for="content">Text</label>
      </div>
    </div>

    <div class="modal-footer">
      <div>
        <button type="button" class="btn btn-danger" onclick="closeModal()">Close</button>
        <button type="button" class="btn btn-primary" onclick="saveTweet()">Save</button>
      </div>
    </div>
  </div>

  <!-- Edit Tweet Modal -->
  <div class="modal-overlay" id="editTweetModalOverlay"></div>
  <div class="custom-modal" id="editTweetModal">
    <div class="container mt-5">
      <div class="form-floating">
        <textarea class="form-control" id="edit-tweet-content" style="height: 200px" maxlength="250"></textarea>
        <label for="edit-tweet-content">Text</label>
      </div>
    </div>

    <div class="modal-footer">
      <div>
        <button type="button" class="btn btn-danger" onclick="closeEditTweetModal()">Close</button>
        <button type="button" class="btn btn-primary" onclick="saveEditTweet()">Save</button>
      </div>
    </div>
  </div>

  <!-- Comment Modal -->
  <div class="modal-overlay" id="commentOverlay"></div>
  <div class="custom-modal" id="commentModal">
    <div class="container mt-5">
      <div class="form-floating">
        <textarea class="form-control" id="comment-content" style="height: 200px" maxlength="250"></textarea>
        <label for="comment-content">Text</label>
      </div>
    </div>

    <div class="modal-footer">
      <div>
        <button type="button" class="btn btn-danger" onclick="closeCommentModal()">Close</button>
        <button type="button" class="btn btn-primary" onclick="saveComment()">Save</button>
      </div>
    </div>
  </div>

  <!-- Edit Comment Modal -->
  <div class="modal-overlay" id="editCommentOverlay"></div>
  <div class="custom-modal" id="editCommentModal">
    <div class="container mt-5">
      <div class="form-floating">
        <textarea class="form-control" id="edit-comment-content" style="height: 200px" maxlength="250"></textarea>
        <label for="edit-comment-content">Text</label>
      </div>
    </div>

    <div class="modal-footer">
      <div>
        <button type="button" class="btn btn-danger" onclick="closeEditCommentModal()">Close</button>
        <button type="button" class="btn btn-primary" onclick="saveEditCommentModal()">Save</button>
      </div>
    </div>
  </div>

  <script>
    // Ambil data tweets ketika dokumen di load
    window.onload = fetchTweets();

    /**
     * Function untuk merequest data tweet
     */
    function fetchTweets() {
      fetch(`api/tweet/index.php`)
        .then(res => res.json())
        .then(res => loadTweet(res))
    }

    /**
     * Function search data
     */
    function fetchSearch() {
      const key = document.querySelector('#search').value;

      fetch(`api/tweet/search.php?key=${key}`)
        .then(res => res.json())
        .then(res => loadTweet(res))
    }

    /**
     * Function untuk meload semua data tweets dan comment
     */
    function loadTweet(tweets) {
      const container = document.querySelector('#tweet-container');
      
      container.innerHTML = ``;

      tweets.forEach(tweet => {
        let tags = tweet.tags.map(a => `#${a}`.trim()).join(' ');
        let cardTweet;

        if (tweet.user_id == localStorage.getItem('user_id')) {
          cardTweet = `<div class="card w-100 mb-2">
                        <div class="card-body">
                          <h5 class="card-title">${tweet.content}</h5>
                          <p class="card-text">Tag: ${tags}</p>
                          <button type="button" class="btn btn-success" onclick="openCommentModal(${tweet.id})">Comment</button>
                          <button type="button" class="btn btn-warning" onclick="openEditTweetModal(${tweet.id})">Edit</button>
                          <button type="button" class="btn btn-danger" onclick="deleteTweet(${tweet.id})">Delete</button>
                        </div>
                      </div>`;
        } else {
          cardTweet = `<div class="card w-100 mb-2">
                        <div class="card-body">
                          <h5 class="card-title">${tweet.content}</h5>
                          <p class="card-text">Tag: ${tags}</p>
                          <button type="button" class="btn btn-success" onclick="openCommentModal(${tweet.id})">Comment</button>
                        </div>
                      </div>`;
        }
        
        container.innerHTML += cardTweet;

        if (tweet.comments.length != 0) {
          tweet.comments.forEach(comment => {
            let tagsComment = comment.tags.map(a => `#${a}`.trim()).join(' ');
            let cardComment;

            if (comment.user_id == localStorage.getItem('user_id')) {
              cardComment = `<div class="card w-90 mb-3">
                              <div class="card-body">
                                <h5 class="card-title">${comment.content}</h5>
                                <p class="card-text">Tag: ${tagsComment}</p>
                                <button type="button" class="btn btn-warning" onclick="openEditCommentModal(${comment.id})">Edit</button>
                                <button type="button" class="btn btn-danger" onclick="deleteComment(${comment.id})">Delete</button>
                              </div>
                            </div>`;
            } else {
              cardComment = `<div class="card w-90 mb-3">
                              <div class="card-body">
                                <h5 class="card-title">${comment.content}</h5>
                                <p class="card-text">Tag: ${tagsComment}</p>
                              </div>
                            </div>`;
            }

            container.innerHTML += cardComment;
          });
        }
      });
    }

    /** 
     * Function untuk menyimpan data tweet yang dibuat
     */
    function saveTweet() {
      const content = document.querySelector('#content').value;

      let data = {
        content
      };

      fetch('api/tweet/create.php', {
        method: 'POST',
        body: JSON.stringify(data)
      })
      .then(res => res.text())
      .then(res => {
        document.querySelector('#content').value = '';

        closeModal();
        fetchTweets();
      });
    }

    /**
     * Function untuk menyimpan perubahan data tweets
     */
    function saveEditTweet() {
      const id = localStorage.getItem('edit_tweets_id');
      const content = document.querySelector('#edit-tweet-content').value;

      let data = {
        id,
        content
      };

      fetch('api/tweet/edit.php', {
        method: 'POST',
        body: JSON.stringify(data)
      })
      .then(res => res.text())
      .then(res => {
        document.querySelector('#edit-tweet-content').value = '';

        closeEditTweetModal();
        fetchTweets();
      });
    }

    /**
     * Function untuk menghapus tweet
     */
    function deleteTweet(id) {
      fetch(`api/tweet/delete.php?id=${id}`)
        .then(res => res.json())
        .then(res => fetchTweets())
    }

    /**
     * Function untuk menyimpan komentar yang dibuat
     */
    function saveComment() {
      let tweets_id = localStorage.getItem('tweets_id');
      const content = document.querySelector('#comment-content').value;

      let data = {
        tweets_id,
        content
      };

      fetch('api/comment/create.php', {
        method: 'POST',
        body: JSON.stringify(data)
      })
      .then(res => res.text())
      .then(res => {
        document.querySelector('#comment-content').value = '';

        closeCommentModal();
        fetchTweets();
      });
    }

    /** 
     * Function untuk menyimpan perubahan dari comment yang dibuat
     */
    function saveEditCommentModal() {
      let comment_id = localStorage.getItem('comment_id');
      const content = document.querySelector('#edit-comment-content').value;

      let data = {
        comment_id,
        content
      };

      fetch('api/comment/edit.php', {
        method: 'POST',
        body: JSON.stringify(data)
      })
      .then(res => res.text())
      .then(res => {
        document.querySelector('#edit-comment-content').value = '';

        closeEditCommentModal();
        fetchTweets();
      });
    }

    /** 
     * Function untuk menghapus comment
     */
    function deleteComment(id) {
      fetch(`api/comment/delete.php?id=${id}`)
        .then(res => res.json())
        .then(res => fetchTweets())
    }

    /** 
     * Function untuk membuka modal create tweets
     */
    function openModal() {
      const modalOverlay = document.querySelector('#modalOverlay');
      const modal = document.querySelector('#modal');

      modalOverlay.classList.add('open');
      modal.classList.add('open');
    }
    
    /** 
     * Function untuk menutup modal create tweets
     */
    function closeModal() {
      const modalOverlay = document.querySelector('#modalOverlay');
      const modal = document.querySelector('#modal');

      modalOverlay.classList.remove('open');
      modal.classList.remove('open');
    }

    /** 
     * Function untuk membuka modal edit tweets
     */
    function openEditTweetModal(id) {
      localStorage.setItem('edit_tweets_id', id);

      const modalOverlay = document.querySelector('#editTweetModalOverlay');
      const modal = document.querySelector('#editTweetModal');

      modalOverlay.classList.add('open');
      modal.classList.add('open');
    }

    /** 
     * Function untuk menutup modal edit tweets
     */
    function closeEditTweetModal() {
      const modalOverlay = document.querySelector('#editTweetModalOverlay');
      const modal = document.querySelector('#editTweetModal');

      modalOverlay.classList.remove('open');
      modal.classList.remove('open');
    }

    /** 
     * Function untuk membuka modal create comment
     */
    function openCommentModal(id) {
      localStorage.setItem('tweets_id', id);

      const modalOverlay = document.querySelector('#commentOverlay');
      const modal = document.querySelector('#commentModal');

      modalOverlay.classList.add('open');
      modal.classList.add('open');
    }

    /** 
     * Function untuk menutup modal create comment
     */
    function closeCommentModal() {
      const modalOverlay = document.querySelector('#commentOverlay');
      const modal = document.querySelector('#commentModal');

      modalOverlay.classList.remove('open');
      modal.classList.remove('open');
    }

    /** 
     * Function untuk membuka modal edit comment
     */
    function openEditCommentModal(id) {
      localStorage.setItem('comment_id', id);

      const modalOverlay = document.querySelector('#editCommentOverlay');
      const modal = document.querySelector('#editCommentModal');

      modalOverlay.classList.add('open');
      modal.classList.add('open');
    }

    /** 
     * Function untuk menutup modal edit comment
     */
    function closeEditCommentModal() {
      const modalOverlay = document.querySelector('#editCommentOverlay');
      const modal = document.querySelector('#editCommentModal');

      modalOverlay.classList.remove('open');
      modal.classList.remove('open');
    }

  </script>
</body>

</html>