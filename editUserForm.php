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
    <title>Edit Form</title>
    <link rel="stylesheet" type="text/css" href="./css/style.css">
    <script src="./js/jquery-3.5.1.min.js"></script>
    <script src="./js/script.js"></script>

   </head> 
  <body>
    <!-- Header -->
    <header class="container">
      <div class="header">
        <h2 class="page-title">Welcome To The Photo Gallery.</h2>
        <a href="logout.php" class="login">Logout</a>
      </div>   
    </header>


    <!-- Main Content -->
    <main class="container">

      <!-- Side Menu -->
      <div class="sec1">
        <div class="left">
          <ul>
            <li><a href="homepage.php">Home</a></li>
            <li><a href="userShow.php">User</a></li>
            <li><a href="registrationForm.php">Registration</a></li>
            <li><a href="albumShow.php">Album</a></li>
            <!-- <li><a href="editAlbum.php">Create Album</a></li> -->
            <li><a href="showMainGallery.php">Gallery</a></li>
          </ul>
        </div>

        <div class="right">
          <form action="updateUser.php" method="post" enctype="multipart/form-data">

            <table border="0" cellpadding="0" cellspacing="0">
              <tbody>

            <?php
              // Database 
                $id = $_GET['id'];
                //Query For EditUser
                $sql = "SELECT * FROM `users` WHERE id = $id";
                $result = $conn->query($sql);

                $row = $result->fetch_assoc();
                $thanaID = $row['thana_id'];
              ?>

              <tr>
                <td></td>
                <td><h3>Edit form</h3></td>
                
              </tr>
              <tr>
                <td></td>
                <td>Please fill in this form to create an account.</td>
                
              </tr>
              <tr><td>
                <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
              </td></tr>
              <tr>
                <td class="label"><label for="first_name"><b>First Name</b></label></td>
                <td><input type="text" placeholder="Enter First Name" name="first_name" value="<?php echo $row['first_name'];?>" ></td>
              </tr>
              <tr>
                <td class="label"><label for="last_name"><b>Last Name</b></label></td>
                 <td><input type="text" placeholder="Enter Last Name" name="last_name" value="<?php echo $row['last_name']?>" ></td>
              </tr>
              <tr>
                <td class="label"><label for="email"><b>Email</b></label></td>
                 <td><input type="text" placeholder="Enter Email" name="email" id="email" value="<?php echo $row['email']; ?>"></td>
              </tr>
            <!--   <tr>
                <td class="label"><label for="phone"><b>Password</b></label></td>
                 <td><input type="text" placeholder="" name="password" value="<?php echo $row['password'];?>" ></td>
              </tr> -->
              <tr>
                <td class="label"><label for="phone"><b>Phone Number</b></label></td>
                 <td><input type="text" placeholder="Phone Number" name="phone" value="<?php echo $row['phone'];?>" ></td>
              </tr>
              <tr>
                <td  class="label"></td>
                <td class=""><img width="100" height="70" src="uploads/profile/<?php echo $row['image']?>" id="img_url" alt="your image" /> 
                  <!-- <img src="" id="img_url" alt="your image"> -->
                  <!-- <br>
                  <input type="file" id="img_file" onChange="img_pathUrl(this);"> -->
                </td>
              </tr>
              <tr>
                <td class="label"><label for="image"><b>Image</b></label></td>
                <td><input type="file" id="img_file" onChange="img_pathUrl(this);" name="image"></td>
              </tr>
              <?php
                if($thanaID != 0){
                  $sqlThana = "SELECT * FROM `thana` WHERE id = $thanaID";
                  $result = $conn->query($sqlThana);
                   // output data of each row
                  $row = $result->fetch_assoc();
                  $districtID = $row['dis_id'];
                  $thanaName = $row['name'];
                  //Query For Districts
                  $sqlDistrict = "SELECT * FROM `districts` WHERE id = $districtID";
                  $result = $conn->query($sqlDistrict);$row = $result->fetch_assoc();
                  $divisionID = $row['div_id'];
                  $disName = $row['name'];

                  //Query For Division
                  $sqlDivision = "SELECT * FROM `divisions` WHERE id = $divisionID";
                  $result = $conn->query($sqlDivision);
                  $row = $result->fetch_assoc();
                   // $divisionID = $row['div_id'];
                  $divName = $row['name'];
                }
              ?>
              <tr>
                <td class="label"><label for="divisionId"><b>Division</b></label></td>

                 <td>
                  <select name="division" id="divisionId" onchange="showDistrict(this.value)">
                  <option value='' > Select Division</option>
                  <?php
                    $result=$conn->query("SELECT * FROM `divisions` ");//ORDER BY name ASC
                     if ($result->num_rows > 0) {
                       // output data of each row
                      while($row = $result->fetch_assoc()) 
                      {
                        echo "<option value='".$row['id']."'". ((!empty($divisionID) && $divisionID == $row['id']) ? 'selected' : '') . ">".$row['name']."</option>";
                    }
                  } 
                  ?>
                  
                </select>
              </td>
              </tr>
              
            </tbody>
            <tbody id="district">
              <tr>
                <td class="label"><label for="districtId"><b>District</b></label></td>
                 <td>
                  <select name="district" id="districtId" >
                  <option value='' > Select District</option>
                  <?php
                    $result=$conn->query("SELECT * FROM `districts` WHERE div_id=" . $divisionID);//ORDER BY name ASC
                     if ($result->num_rows > 0) {
                       // output data of each row
                      while($row = $result->fetch_assoc()) 
                      {
                        echo "<option value='".$row['id']."'". ((!empty($districtID) && $districtID == $row['id']) ? 'selected' : '') . ">".$row['name']."</option>";
                    }
                  } 
                  ?>
                  </select>
              </td>
              </tr>
              <tr>
                <td class="label"><label for="thanaId"><b>Thana</b></label></td>
                 <td id="thana">
                  <select name="thana" id="thanaId">
                  <option value='0' > Select Thana</option>
                  <?php
                    $result=$conn->query("SELECT * FROM `thana` WHERE dis_id=" . $districtID);//ORDER BY name ASC
                     if ($result->num_rows > 0) {
                       // output data of each row
                      while($row = $result->fetch_assoc()) 
                      {
                        echo "<option value='".$row['id']."'". ((!empty($thanaID) && $thanaID == $row['id']) ? 'selected' : '') . ">".$row['name']."</option>";
                    }
                  } 
                  ?>
                </select>
              </td>
              </tr>
            </tbody>
              
              <tr>
                <td></td>
                <td><button type="submit" class="uploadbtn">Update</button></td>
               
              </tr>
             
            </table>
            
           
            
            <!-- <div>
              <?php //requrire('footer.php'); ?>
            </div> -->
            
          </form>
        </div>
      </div>
    </main>
    <!-- Footer -->   
    <footer class="container">
      <div class="footer"><p >This is footer</p></div>
    </footer>

  </body>
</html>