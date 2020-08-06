<?php
	require_once('connect.php');
    session_start();
    if(!isset($_SESSION['email'])){
      header('Location: homepage.php');
    }
	if(!isset($_POST['submit'])){
        $uploadsDir = "uploads/profile/";
		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$email = $_POST['email'];
        $password = md5($_POST['password']);
		$phone = $_POST['phone'];
		$thana_id = $_POST['thana'];
		 
		$fileName        = uniqid().$_FILES['image']['name'];
        // echo "<pre>";
        //  print_r($fileName);
        //  exit;
        $tempLocation    = $_FILES['image']['tmp_name'];
        $targetFilePath  = $uploadsDir . $fileName;
        if($_FILES['image']['name'] == ""){
            $sql = "INSERT INTO `users` (`thana_id`, `first_name`, `last_name`, `email`, `password`, `phone`) VALUES ($thana_id, '$first_name', '$last_name', '$email', '$password', '$phone');";
           //echo $sql;exit;
            if ($conn->query($sql) === TRUE) {
                $_SESSION['create'] = "Successfully created user";
                header('Location: userShow.php');
            } 
        }else{
            if(move_uploaded_file($tempLocation, $targetFilePath)){
                    $insert = $conn->query("INSERT INTO `users`(`thana_id`, `first_name`, `last_name`, `email`, `password`, `phone`, `image`) VALUES ($thana_id, '$first_name', '$last_name','$email','$password', '$phone', '$fileName')");
                    // echo "INSERT INTO `users`(`thana_id`, `first_name`, `last_name`, `email`, `password`, `phone`, `image`) VALUES ($thana_id, '$first_name', '$last_name','$email','$password', '$phone', '$fileName'";
                    if($insert) {
                        $_SESSION['create'] = "Successfully created User";
                        header('Location: userShow.php');
                    }
            }
        }
	} else{
         header('Location: homepage.php');
    }
