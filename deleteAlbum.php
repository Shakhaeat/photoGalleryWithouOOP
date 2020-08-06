<?php
  require_once('connect.php');
  session_start();
  if(!isset($_SESSION['email'])){
    header('Location: homepage.php');
  }
      

  if(isset($_GET['id'])){
      $id = $_GET['id'];
     // echo $id;
      $fileSql = "SELECT `image` FROM `album` WHERE id = $id";
      $fileResult = $conn->query($fileSql);
      $fileRow = $fileResult->fetch_assoc();

      $filepath = "uploads/cover/".$fileRow['image'];

      $sql = "DELETE FROM `album` WHERE id = $id";
      
      //echo $sql;
      if ($conn->query($sql) === TRUE) {

        if (is_file($filepath)){
          unlink($filepath);
        }
        $_SESSION['delete'] = "Successfully deleted album";
        header('Location: albumShow.php');
    }else{
        header('Location: homepage.php');
    }
  }

  $conn->close();
?>