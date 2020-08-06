<?php
  require('connect.php');
  session_start();
  if(!isset($_SESSION['email'])){
    header('Location: homepage.php');
  }
  if(isset($_GET['id'])){
    $id = $_GET['id'];
    //echo $id;
    $fileSql = "SELECT `image` FROM `users` WHERE id = $id";
    $fileResult = $conn->query($fileSql);
    $fileRow = $fileResult->fetch_assoc();

    $filepath = "uploads/profile/".$fileRow['image'];

    $sql = "DELETE FROM users WHERE id = $id";
   // echo $filepath;exit;
    if ($conn->query($sql) === TRUE) {
      if (is_file($filepath))
      {
        unlink($filepath);
      }
      $_SESSION['delete'] = "Successfully deleted user";
      header('Location: userShow.php');
    } 
  }else{
      header('Location: homepage.php');
  }

  $conn->close();
?>
    