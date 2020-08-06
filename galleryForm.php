<?php
  require_once('connect.php');
  session_start();
  if(!isset($_SESSION['email'])){
    header('Location: homepage.php');
  }
?>
<!DOCTYPE html>
<html>
<head>
  <title>Gallery Form</title>
  <link rel="stylesheet" type="text/css" href="./css/style.css">
</head>
<body>
  <!-- Header -->  
  <header class="header">
    <div class="container">
      <h2 class="page-title">Welcome To The Photo Gallery.</h2>
      <a href="logout.php" class="login">Logout</a>
    </div>   
  </header>
  <!-- Main Content -->  
  <main class="container">
    <!-- Side Menu -->
    <div class="sec1">
      <div class="left">
        <ul>
          <li><a href="homepage.php">Home</a></li>
          <li><a href="userShow.php">User</a></li>
          <li><a href="registrationForm.php">Registration</a></li>
          <li><a href="albumShow.php">Album</a></li>
          <!-- <li><a href="editAlbum.php">Create Album</a></li> -->
          <li><a href="showMainGallery.php">Gallery</a></li>
        </ul>
      </div>

      <div class="right">
        <form action="gallery.php" method="post" enctype="multipart/form-data">
          <div class="container">
            <h1>Upload Multiple Photo</h1>
            
            

            <!-- <label ><b>Event Name</b></label>-->

            <?php

              $sql = "SELECT * FROM `album` ORDER BY id DESC ";
              $result = $conn->query($sql);
            ?>

            <label>Choose Event Name</label>

            <select name = "id" required>
              <option value="">---- Select Album ----</option>
              <?php
               if ($result->num_rows > 0) {
              // output data of each row
                while($row = $result->fetch_assoc()) {
              ?>

               <option value="<?php echo $row['id']?>"><?php echo $row['event_name'] ?></option>
            

           <?php
                }

              } ?>
              </select><br>
            </select>

            <input type="file" name="image[]" class="custom-file-input" multiple>
            

            <button type="submit" class="uploadbtn">Upload</button>
          </div>
          
          
        </form>
      </div>
    </div>
  </main>

  <!-- Footer -->   
  <footer class="footer">
    <div class="container"><p >This is footer</p></div>
  </footer>

</body>
</html>