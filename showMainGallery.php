<?php
require_once('connect.php');
session_start();
?>


<!DOCTYPE html>
<html>

<head>
  <title>Gallery</title>
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
  $result_count = $conn->query("SELECT COUNT(*) As total_records FROM `gallery`");
  $total_records = $result_count->fetch_assoc();

  $total_records = $total_records['total_records'];

  $total_no_of_pages = ceil($total_records / $total_records_per_page);
  $second_last = $total_no_of_pages - 1; // total pages minus 1
  // echo $second_last;
  // exit;

  //End pagination
  ?>

  <!-- Main Content -->
  <main class="container">
    <div class="tle">
      <h3>Photo Gallery</h3>
    </div>
    <?php
    if (isset($_SESSION['email'])) {
    ?>
      <div>
        <a href="galleryForm.php" class="btn3">Create Gallery</a>
      </div>
    <?php
    }
    ?>
    <!-- Side Menu -->
    <div class="sec1">
      <div class="left">
        <ul>
          <li><a href="homepage.php">Home</a></li>
          <li><a href="userShow.php">User</a></li>
          <li><a href="registrationForm.php">Registration</a></li>
          <!--  <li><a href="editAlbum.php">Create Album</a></li> -->
          <li><a href="albumShow.php">Album</a></li>
          <li><a href="showMainGallery.php">Gallery</a></li>
        </ul>
      </div>

      <div class="right">
        <table class="editTable">
          <tr>
            <th class="box" width="10%">Serial</th>
            <th class="box" width="15%">Event Name</th>
            <th class="box" width="10%">Gallery Photo</th>
            <?php
            if (isset($_SESSION['email'])) {
            ?>
              <th class="box" width="15%">Action</th>
            <?php
            }
            ?>
          </tr>

          <?php
          // $sql = "SELECT * FROM `gallery` ORDER BY id DESC";
          $sql = "SELECT `album`.event_name, `gallery`.id, `gallery`.image
                      FROM `gallery`
                      INNER JOIN `album` 
                      WHERE `album`.id = `gallery`.album_id
                      ORDER BY event_name
                      LIMIT $offset, $total_records_per_page 
                      ";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
            $var = $offset + 1;
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
              echo '<td class="box" ><img width="80" height="40" src="uploads/gallery/' . $row['image'] . '"/></td>';
              if (isset($_SESSION['email'])) {
                echo "<td class='box'><a class='btn2' href='editGalleryForm.php?id=" . $row['id'] . "'>" . 'Edit' . "</a>" . '' . "<a onclick='javascript:confirmationDelete($(this));return false;' class='btnDel' href='deleteGallery.php?id=" . $row['id'] . "'>" . 'Delete' . "</td></tr>";
              }
              ?>

          <?php
              $var++;
            }
          } else {
            echo "<tr><td><h2 class = 'msg'>No Album Found</h2></td></tr>";
          }
          ?>

        </table>

        <?php 
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
  <footer class="footer">
    <div class="container">
      <p>This is footer</p>
    </div>
  </footer>
</body>

</html>