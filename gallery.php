<?php 
  require_once('connect.php');
  session_start();
  if(!isset($_SESSION['email'])){
    header('Location: homepage.php');
  }
    $var = 0;
    if(!isset($_POST['submit'])){
        $uploadsDir = "uploads/gallery/";
        
        // Velidate if files exist
        if (!empty(array_filter($_FILES['image']['name']))) {
            foreach($_FILES['image']['name'] as $key=>$val){
                // Get files upload path
                
                $album_id = $_POST["id"];
                $fileName        = uniqid().$_FILES['image']['name'][$key];
                $tempLocation    = $_FILES['image']['tmp_name'][$key];
                $targetFilePath  = $uploadsDir . $fileName;
                //$targetFilePath  = $uploadsDir . basename($_FILES["image"]["name"][$key]);
                // echo "<pre>";
                // //print_r($fileName);
                // print_r($targetFilePath);
                //print_r($tempLocation);
              //  $targetFilePath  = $uploadsDir/$fileName;
              //  $fileType        = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
                
               
                if(move_uploaded_file($tempLocation, $targetFilePath)){
                    $insert = $conn->query("INSERT INTO `gallery`(`album_id`, `image`) VALUES ('$album_id', '$fileName')");
                    if($insert) {
                        $var = 1;
                       // header('Location: galleryShow.php?status=1');
                    } else {
                        $var = 0;
                    }
                }
            }
            if($var == 1){
                $_SESSION['create'] = "Successfully created gallery";
                header('Location: albumShow.php');
            }

        } else {
            
        }
    }
    $conn->close();
 
?>