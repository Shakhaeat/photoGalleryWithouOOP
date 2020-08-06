<?php
  require_once('connect.php');
  session_start();
  if (!isset($_SESSION['email'])) {
    header('Location: homepage.php');
  }
?>


<!DOCTYPE html>
<html>

<head>
  <title>Album</title>
  <link rel="stylesheet" type="text/css" href="./css/style.css">
  <script src="./js/jquery-3.5.1.min.js"></script>
  <script src="./js/script.js"></script>
</head>

<body>
  <!-- Header -->
  <header class="container">
    <div class="header">
      <h2 class="page-title">Welcome To The Photo Gallery.</h2>
      <a href="logout.php" class="login">Logout</a>
    </div>
  </header>



  <!-- Main Content -->
  <main class="container">
    <div>
      <a href="albumForm.php" class="btn3">Create Album</a>
    </div>
    <!-- Side Menu -->
    <div class="sec1">
      <div class="left">
        <ul>
          <li><a href="homepage.php">Home</a></li>
          <li><a href="userShow.php">User</a></li>
          <li><a href="registrationForm.php">Registration</a></li>
          <li><a href="albumShow.php">Album</a></li>
          <!--  <li><a href="editAlbum.php">Create Album</a></li> -->
          <li><a href="showMainGallery.php">Gallery</a></li>
        </ul>
      </div>

      <div class="right">
        <table class="editTable">

          <tr>
            <th class="box" width="5%">Serial</th>
            <th class="box" width="15%">Event Name</th>
            <th class="box" width="10%">Cover Photo</th>
            <th class="box" width="15%">Action</th>
          </tr>

          <?php
          $sql = "SELECT * FROM `album` ORDER BY id DESC";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
            $var = 1;
            // output data of each row
            while ($row = $result->fetch_assoc()) {
          ?>

              <?php
              // echo "event: " . $row["event_name"] ."<br>";
              echo "<tr><td class='box'>" . $var . "</td>";
              echo "<td class='box'>" . $row["event_name"] . "</td>";
              // echo "<td class='box'>" . $row["last_name"] ."</td>"; 
              // echo "<td class='box'>" . $row["email"] ."</td>"; 
              // echo "<td class='box'>" . $row["phone"] ."</td>"; 
              echo '<td class="box" ><img class="image" width="80" height="50" src="uploads/cover/' . $row['image'] . '"/></td>';
              echo "<td class='box'><a class='btn2' href='editAlbumForm.php?id=" . $row['id'] . "'>" . 'Edit' . "</a>" . ' | ' . "<a onclick='javascript:confirmationDelete($(this));return false;' class='btnDel' href='deleteAlbum.php?id=" . $row['id'] . "'>" . 'Delete' . "</td></tr>";
              ?>

          <?php
              $var++;
            }
          } else {
            echo "<tr><td class = 'msg'>No Album Found</td></tr>";
          }
          ?>

        </table>

        <?php $conn->close(); ?>
      </div>
    </div>
  </main>

  <!-- Footer -->
  <footer class="footer">
    <div class="container">
      <p>This is footer</p>
    </div>
  </footer>
</body>

</html>