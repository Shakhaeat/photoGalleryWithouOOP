<?php
  require_once('connect.php');
  session_start();
  if (!isset($_SESSION['email'])) {
    header('Location: homepage.php');
  }
?>
<!DOCTYPE html>
<html>

<head>
  <script>

  </script>
</head>


<body>
  <?php
  $id = !empty($_GET['id']) ? $_GET['id'] : 0;
  //echo $id;
  $sql = "SELECT * FROM districts WHERE div_id = " . $id;
  //echo $sql;
  $result = $conn->query($sql);
  ?>
  <tr>
    <td class="label"><label for="districtId"><b>District</b></label></td>
    <td>
      <select name="district" id="districtId" onchange="showThana(this.value)">

        <option>Select District</option>
        <?php
        if (!empty($result) && $result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
        ?>
            <?php
            echo "<option value=" . $row['id'] . ">" . $row['name'] . "</option>"; ?>
        <?php
          }
        } ?>
      </select>
    </td>
  </tr>
  <tr>
    <td class="label"><label for="thanaId"><b>Thana</b></label></td>
    <td id="thana">
      <select name="thana" id="thanaId" required>
        <option value="">Select Thana</option>
      </select>
    </td>
  </tr>



  <?php
  $conn->close();
  ?>






</body>

</html>