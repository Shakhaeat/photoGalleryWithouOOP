<?php 
    require_once('connect.php');
    session_start();
    if(!isset($_SESSION['email'])){
      header('Location: homepage.php');
    }
?>

<!DOCTYPE html>
<html>
<head>
</head>


<body>

<?php

	$id = intval($_GET['id']);
	//echo $id;
	$sql = "SELECT * FROM thana WHERE dis_id = $id";
	//echo $sql;
  $result = $conn->query($sql);?>
  <select name="thana" id="thanaId"> 
  <option value="">Select Thana</option>
  <?php
  	if (!empty($result) && $result->num_rows > 0) { 
    	while($row = $result->fetch_assoc()) {
    	 echo "<option value=".$row['id'].">".$row['name']."</option>"; 
    	}
    }
  ?>
  </select>
  <?php
    $conn->close(); 
  ?>

</body>
</html>