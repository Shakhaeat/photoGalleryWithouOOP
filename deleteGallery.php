<?php
  require_once('connect.php');
  session_start();
  if(!isset($_SESSION['email'])){
    header('Location: homepage.php');
  }
      

  if(isset($_GET['id'])){
    $id = $_GET['id'];
   // echo $id;
    $fileSql = "SELECT `image` FROM `gallery` WHERE id = $id";

    $fileResult = $conn->query($fileSql);
    $fileRow = $fileResult->fetch_assoc();
    $filepath = "uploads/gallery/".$fileRow['image'];
   // echo $filepath;exit;
    $sql = "DELETE FROM `gallery` WHERE `id` = $id";
    
    //echo $sql;
    if ($conn->query($sql) === TRUE) {
      if (is_file($filepath)){
        unlink($filepath);
      }

      $_SESSION['delete'] = "Successfully deleted user";
      header('Location: showMainGallery.php');
     // }
    } 
  }else{
      header('Location: homepage.php');
  }

  $conn->close();
?>
