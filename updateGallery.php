<?php
    require_once('connect.php');
    session_start();
    if(!isset($_SESSION['email'])){
      header('Location: homepage.php');
    }

	if(!isset($_POST['submit'])){
	    $uploadsDir = "uploads/gallery/";

		$event_id = $_POST['event'];
		$id = $_POST['id'];

		$fileName        = $_FILES['image']['name'];
	    $tempLocation    = $_FILES['image']['tmp_name'];
	    $targetFilePath  = $uploadsDir . basename($_FILES["image"]["name"]);
	    //echo $id;

	    if($fileName == ""){
	    	$sql = "UPDATE `gallery` SET `album_id` = '$event_id' WHERE id = $id";
		    echo $sql;
			if ($conn->query($sql) === TRUE) {
			    $_SESSION['update'] = "Gallery record has been updated Successfully!";
				header('Location: showMainGallery.php');
			} else {
			  echo "Error updating record: " . $conn->error;
			}
	    }else{
	        if(move_uploaded_file($tempLocation, $targetFilePath)){

				$sql = "UPDATE `gallery` SET `album_id` = '$event_id', `image` = '$fileName' WHERE id = $id";
			    
				if ($conn->query($sql) === TRUE) {
				    $_SESSION['update'] = "User record has been updated Successfully!";
					header('Location: showMainGallery.php');
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