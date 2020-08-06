<?php 
    // Database
    include 'connect.php'; 
    session_start();
    if(!isset($_SESSION['email'])){
      header('Location: homepage.php');
    }
    if(!isset($_POST['submit'])){
        $uploadsDir = "uploads/cover/";
        $event_name      = $_POST['event'];
        
        $fileName        = uniqid().$_FILES['image']['name'];
        $tempLocation    = $_FILES['image']['tmp_name'];

        $targetFilePath  = $uploadsDir . $fileName;
        //$targetFilePath  = $uploadsDir . $fileName;
       // $targetFilePath  = $uploadsDir . basename($_FILES["image"]["name"]);
        // echo "<pre>";
        // //print_r($fileName);
        // print_r($targetFilePath);
        // //print_r($tempLocation);
        // exit;
        if(move_uploaded_file($tempLocation, $targetFilePath)){
            $insert = $conn->query("INSERT INTO `album`(`event_name`, `image`) VALUES ('$event_name', '$fileName')");
                $id = $conn->insert_id;
            if($insert) {
                $_SESSION['create'] = "Successfully created album";
                header('Location: albumShow.php');
            } else {
                echo "Fail";
                $response = array(
                    "status" => "alert-danger",
                    "message" => "Files coudn't be uploaded due to database error."
                );
            }
        }
            //}

        
    }else{
        header('Location: homepage.php');
    }
    $conn->close();
