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
		$phone = $_POST['phone'];
		$thana_id = $_POST['thana'];
		//$image = $_POST['image'];
		$id = $_POST['id'];

		$fileName        = $_FILES['image']['name'];
        $tempLocation    = $_FILES['image']['tmp_name'];
        $targetFilePath  = $uploadsDir . basename($_FILES["image"]["name"]);
        //echo $id;

        if($_FILES['image']['name'] == ""){
        	$sql = "UPDATE `users` SET `thana_id`=$thana_id,`first_name` = '$first_name',`last_name` = '$last_name', `email` = '$email',`phone` = '$phone' WHERE id = $id";
		   //echo $sql;exit;
			if ($conn->query($sql) === TRUE) {
			  	$_SESSION['update'] = "User record has been updated Successfully!";
				header('Location: userShow.php');
			} else {
			  echo "Error updating record: " . $conn->error;
			}
        }else{
	         if(move_uploaded_file($tempLocation, $targetFilePath)){

				$sql = "UPDATE `users` SET `thana_id`=$thana_id,`first_name` = '$first_name',`last_name` = '$last_name', `email` = '$email',`phone` = '$phone', `image` = '$fileName' WHERE id = $id";

			    
				if ($conn->query($sql) === TRUE) {
				    $_SESSION['update'] = "User record has been updated Successfully!";
				    $_SESSION['image'] = $fileName;
					header('Location: userShow.php');
				} else {
				  echo "Error updating record: " . $conn->error;
				}
			}
		}
	}else{
        header('Location: homepage.php');
    }

	$conn->close();
	

?>