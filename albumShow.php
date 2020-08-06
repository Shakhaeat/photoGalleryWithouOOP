<?php
require_once('connect.php');
session_start();
?>
<!DOCTYPE html>
<html>

<head>
  <title>Album Show</title>
  <link rel="stylesheet" type="text/css" href="./css/style.css">
  <script src="./js/jquery-3.5.1.min.js"></script>
  <script src="./js/script.js"></script>

</head>

<body>
  <!-- Header -->
  <header class="container">
    <div class="header">
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

  <!-- For massage show -->
  <?php
  if (isset($_SESSION['create'])) {
    echo "<div class = 'hideDiv' id='hideDiv'>" . $_SESSION['create'] . '</div>';
    unset($_SESSION['create']);
  } elseif (isset($_SESSION['delete'])) {
    echo "<div class = 'hideDiv' id='hideDiv'>" . $_SESSION['delete'] . '</div>';
    unset($_SESSION['delete']);
  } elseif (isset($_SESSION['update'])) {
    echo "<div class = 'hideDiv' id='hideDiv'>" . $_SESSION['update'] . '</div>';
    unset($_SESSION['update']);
  }
  ?>

  <!-- Main Content -->
  <main class="container">
    <div class="tle">
        <h3>Photo Album</h3>
      </div>
    <?php
    if (isset($_SESSION['email'])) {
    ?>
      
      <div>
        <a href="albumForm.php" class="btn3">Create Album</a></li>
        <!-- <a href="deleteAlbum.php" class="btnDel">Delete Album</a></li> -->

      </div>
    <?php
    }
    ?>
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
            // echo '<li><a href="editAlbum.php">Create Album</a></li>';
          }
          ?>
          <li><a href="albumShow.php">Album</a></li>
          <?php
          if (isset($_SESSION['email'])) { ?>
            <li><a href="showMainGallery.php">Gallery</a></li>
          <?php
          }
          ?>
        </ul>
      </div>

      <div class="right">


        <?php

        //Pagination
        if (isset($_GET['page_no']) && $_GET['page_no'] != "") {
          $page_no = $_GET['page_no'];
        } else {
          $page_no = 1;
        }
        $total_records_per_page = 3;
        $offset = ($page_no - 1) * $total_records_per_page;
        $previous_page = $page_no - 1;
        $next_page = $page_no + 1;
        $adjacents = "2";
        $result_count = $conn->query("SELECT COUNT(*) As total_records FROM `album`");
        $total_records = $result_count->fetch_assoc();

        $total_records = $total_records['total_records'];

        $total_no_of_pages = ceil($total_records / $total_records_per_page);
        $second_last = $total_no_of_pages - 1; // total pages minus 1
        // echo $second_last;
        // exit;

        //End pagination



        $sql = "SELECT * FROM `album` ORDER BY id DESC LIMIT $offset, $total_records_per_page";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          // output data of each row
          while ($row = $result->fetch_assoc()) {
        ?>
            <div class="gallery">
              <?php
              // echo "event: " . $row["event_name"] ."<br>";
              //$src = !empty($row['image']) ? 'uploads/profile/'.$row['image'] : 'uploads/noAvailable.jpg';
              echo '<a href="galleryShow.php?id=' . $row['id'] . '"> <img src="uploads/cover/' . $row['image'] . '"/> </a>';
              echo "<h4>Event Name: " . $row["event_name"] . "</h4>";
              if (isset($_SESSION['email'])) {
                echo "<div class='desc'><a class='btn2' href='editAlbumForm.php?id=" . $row['id'] . "'>" . 'Edit' . "</a>" . ' | '
                  . "<a onclick='javascript:confirmationDelete($(this));return false;' class='btnDel' href='deleteAlbum.php?id=" . $row['id'] . "'>" . 'Delete' . "</a></div>";
              }
              ?>
            </div>
        <?php
          }
        } else {
          echo "<h2 class = 'msg'>No Album Found</h2>";
        }
        //exit;
          if($total_records!=0){ 
        ?>
        <table border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td class="page">
              <strong>Page <?php echo $page_no . " of " . $total_no_of_pages; ?></strong>
            </td>
            <td>
              <ul class="nav">
                <?php
                if ($page_no > 1) {
                  echo "<li><a href='?page_no=1'>&#10218;</a></li>";
                }
                if ($page_no == 1) {
                  echo "<li><a class = 'disabled'>&#10218;</a></li>";
                  echo "<li><a class = 'disabled'>&#10216;</a></li>";
                }
                ?>
                <li>
                  <?php
                  if ($page_no > 1) {
                    //$t="galleryShow.php?page_no=".$previous_page."&id=".$album_id;
                    // echo $t;
                    // exit;

                    echo "<a href='?page_no=$previous_page'> &#10216;</a>";
                  }
                  ?>

                </li>


                <?php

                if ($total_no_of_pages <= 10) {
                  for ($counter = 1; $counter <= $total_no_of_pages; $counter++) {
                    if ($counter == $page_no) {
                      echo "<li class='active'><a>$counter</a></li>";
                    } else {
                      echo "<li><a href='?page_no=$counter'>$counter</a></li>";
                    }
                  }
                } elseif ($total_no_of_pages > 10) {
                  if ($page_no < 3) {
                    for ($counter = $page_no; $counter < ($page_no + 2); $counter++) {
                      if ($counter == $page_no) {
                        echo "<li class='active'><a>$counter</a></li>";
                      } else {
                        echo "<li><a href='?page_no=$counter'>$counter</a></li>";
                      }
                    }
                    echo "<li><a>...</a></li>";
                    echo "<li><a href='?page_no=$second_last'>$second_last</a></li>";
                    echo "<li><a href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
                  } elseif ($page_no >= 3 && $page_no < 9) {
                    for ($counter = $page_no; $counter < ($page_no + 2); $counter++) {
                      if ($counter == $page_no) {
                        echo "<li class='active'><a>$counter</a></li>";
                      } else {
                        echo "<li><a href='?page_no=$counter'>$counter</a></li>";
                      }
                    }
                    echo "<li><a>...</a></li>";
                    for ($counter = $total_no_of_pages - 1; $counter <= $total_no_of_pages; $counter++) {
                      if ($counter == $page_no) {
                        echo "<li class='active'><a>$counter</a></li>";
                      } else {
                        echo "<li><a href='?page_no=$counter'>$counter</a></li>";
                      }
                    }
                  } else {
                    for ($counter = $page_no; $counter <= $total_no_of_pages; $counter++) {
                      if ($counter == $page_no) {
                        echo "<li class='active'><a>$counter</a></li>";
                      } else {
                        echo "<li><a href='?page_no=$counter'>$counter</a></li>";
                      }
                    }
                  }
                }
                ?>
                <li <?php
                    if ($page_no >= $total_no_of_pages) {
                      echo "class='disabled'";
                    }
                    ?>>
                  <?php
                  if ($page_no < $total_no_of_pages) {


                    echo "<a href='?page_no=$next_page'>&#10217;</a>";
                  }
                  ?>
                </li>

                <?php
                if ($page_no < $total_no_of_pages) {
                  echo "<li><a href='?page_no=$total_no_of_pages'>&#10219;</a></li>"; //&rsaquo;&rsaquo;
                }
                if ($page_no == $total_no_of_pages) {
                  echo "<li><a class = 'disabled'>&#10217;</a></li>";
                  echo "<li><a class = 'disabled'>&#10219;</a></li>";
                }
                ?>
              </ul>
            </td>
          </tr>
        </table>
        <?php 
          }
          $conn->close();
        ?>

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