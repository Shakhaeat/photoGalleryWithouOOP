<?php
require_once('connect.php');
session_start();
//echo $_SESSION['image'];
?>
<!DOCTYPE html>
<html>

<head>
  <title>Homepage</title>
  <link rel="stylesheet" type="text/css" href="./css/style.css">
  <script src="./js/jquery-3.5.1.min.js"></script>
  <script src="./js/script.js"></script>


</head>

<body>

  <!-- Header -->
  <header class="header">
    <div class="container">
      <?php if (isset($_SESSION['email'])) { ?>
        <!--  <a href="profile.php"> -->
        <img src="uploads/profile/<?php echo $_SESSION['image']; ?>" class="design">
        <!-- </a> -->
      <?php } ?>
      <h2 class="page-title">Welcome To The Photo Gallery.</h2>
      <?php if (!isset($_SESSION['email'])) { ?>
        <a href="loginForm.php" class="login">Login</a>
      <?php
      } else {
      ?>
        <a href="logout.php" class="login">Logout</a>

      <?php } ?>
    </div>
  </header>
  <main class="container">

    <!-- Side Menu -->
    <div class="sec1">
      <div class="left">
        <ul>
          <li><a href="homepage.php">Home</a></li>
          <?php
          //echo $_SESSION['email'];
          if (isset($_SESSION['email'])) {
            echo '<li><a href="userShow.php">User</a></li>';
            echo '<li><a href="registrationForm.php">Registration</a></li>';
          }
          ?>
          <li><a href="albumShow.php">Album</a></li>
          <?php
          if (isset($_SESSION['email'])) {
          ?>
            <!-- <li><a href="editAlbum.php">Create Album</a></li> -->
            <li><a href="showMainGallery.php">Gallery</a></li>
          <?php
          }
          ?>

        </ul>
      </div>

      <div class="right">
        <?php
        if (isset($_SESSION['success'])) {
          echo "<div class = 'hideDiv' id='hideDiv'>" . $_SESSION['success'] . '</div>';
          unset($_SESSION['success']);
        }
        ?>

        <p>A positive first impression is a vital start to forging a strong relationship with potential customers. Welcome messages act as a great strategy to be a part of the customer journey, understand them more, and provide better understanding of taking the next action to use the product successfully. A positive first impression is a vital start to forging a strong relationship with potential customers. Welcome messages act as a great strategy to be a part of the customer journey, understand them more, and provide better understanding of taking the next action to use the product successfully. A positive first impression is a vital start to forging a strong relationship with potential customers. Welcome messages act as a great strategy to be a part of the customer journey, understand them more, and provide better understanding of taking the next action to use the product successfully. A positive first impression is a vital start to forging a strong relationship with potential customers. Welcome messages act as a great strategy to be a part of the customer journey, understand them more, and provide better understanding of taking the next action to use the product successfully. A positive first impression is a vital start to forging a strong relationship with potential customers. Welcome messages act as a great strategy to be a part of the customer journey, understand them more, and provide better understanding of taking the next action to use the product successfully. A positive first impression is a vital start to forging a strong relationship with potential customers. Welcome messages act as a great strategy to be a part of the customer journey, understand them more, and provide better understanding of taking the next action to use the product successfully. A positive first impression is a vital start to forging a strong relationship with potential customers. Welcome messages act as a great strategy to be a part of the customer journey, understand them more, and provide better understanding of taking the next action to use the product successfully.A positive first impression is a vital start to forging a strong relationship with potential customers. Welcome messages act as a great strategy to be a part of the customer journey, understand them more, and provide better understanding of taking the next action to use the product successfully. A positive first impression is a vital start to forging a strong relationship with potential customers. Welcome messages act as a great strategy to be a part of the customer journey, understand them more, and provide better understanding of taking the next action to use the product successfully. A positive first impression is a vital start to forging a strong relationship with potential customers. Welcome messages act as a great strategy to be a part of the customer journey, understand them more, and provide better understanding of taking the next action to use the product successfully.</p>
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