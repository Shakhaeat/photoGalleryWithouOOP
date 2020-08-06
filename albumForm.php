<?php
//require_once('connect.php');
session_start();
if (!isset($_SESSION['email'])) {
  header('Location: homepage.php');
}

?>
<!DOCTYPE html>
<html>

<head>
  <title>Album Form</title>
  <link rel="stylesheet" type="text/css" href="./css/style.css">
</head>

<body>

  <!-- Header -->
  <header class="container">
    <div class="header">
      <h2 class="page-title">Welcome To The Photo Gallery.</h2>
      <a href="logout.php" class="login">Logout</a>
    </div>
  </header>
  <!-- Main content -->
  <main class="container">

    <!-- Side Menu -->
    <div class="sec1">
      <div class="left">
        <ul>
          <li><a href="homepage.php">Home</a></li>
          <?php
          if (isset($_SESSION['email'])) {
            echo '<li><a href="userShow.php">User</a></li>';
            echo '<li><a href="registrationForm.php">Registration</a></li>';
          }
          ?>
          <li><a href="albumShow.php">Album</a></li>
          <!-- <li><a href="editAlbum.php">Create Album</a></li> -->
          <li><a href="showMainGallery.php">Gallery</a></li>
        </ul>
      </div>

      <div class="right">
        <form action="album.php" method="post" enctype="multipart/form-data">



          <table border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td></td>
              <td>
                <h3>Upload Photo</h3>
              </td>

            </tr>
            <tr>
              <td class="label"><label><b>Event Name: </b></label></td>
              <td> <input type="text" placeholder="Enter Event Name" name="event" id="event" required></td>

            </tr>
            <tr>
              <td class="label"><label><b>Cover Photo: </b></label></td>

              <td><input type="file" name="image" class="custom-file-input" required></td>

            </tr>
            <tr>
              <td></td>
              <td><button type="submit" class="uploadbtn">Upload</button></td>

            </tr>

          </table>






        </form>
      </div>
    </div>
  </main>

  <!-- Footer -->
  <footer class="container">
    <div class="footer">
      <p>This is footer</p>
    </div>
  </footer>

</body>

</html>