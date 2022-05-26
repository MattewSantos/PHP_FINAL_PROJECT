<?php
$dbCon = new mysqli($DBserver, $username, $password, $dbName);

if ($dbCon->connect_error) {
  die("DB error: " . $dbCon->connect_error);
} else {
  if (isset($_GET['LE'])) {
    $locationId = $_GET['LE'];
    $selectQuery = "SELECT * FROM locations_tb WHERE location_id='$locationId'";
    $info = $dbCon->query($selectQuery);
    if ($info->num_rows == 1) {
      $info = $info->fetch_assoc();
      $locationName = $info['name'];
      $locationAdd = $info['address'];
      $locationManager = $info['manager_id'];
    }
  }
}
$dbCon->close();
?>


<div class="editLocationForm">
  <h3>Edit Location</h3>
  <form method="POST" action="index?SEL">
    <label for="ID">ID</label>
    <br>
    <input type="text" name="ID" value="<?php echo $locationId ?>" readonly>
    <br>
    <input type="text" name="company_name" value="<?php echo $locationName ?>">
    <br>
    <input type="text" name="company_address" value="<?php echo $locationAdd ?>" required>
    <br>
    <label for="select_manager">Choose the responsible manager for this location</label>
    <br>
    <select name="select_manager" required>
      <?php
      $dbcon = new mysqli($DBserver, $username, $password, $dbName);
      if ($dbcon->connect_error) {
        die("DB error");
      } else {
        // UPDATE
        $selectQuery = "SELECT * FROM users_tb WHERE user_roll='manager'";
        $ManagerList = $dbcon->query($selectQuery);
        if ($ManagerList->num_rows > 0) {
          while ($manager = $ManagerList->fetch_assoc()) {
            if ($manager['user_id'] == $locationManager) {
              $selected = 'selected="selected"';
            }
            echo "<option value='" . $manager['user_id'] . "'" . $selected . ">" . "  " . $manager['first_name'] . "  " . $manager['last_name'] . " ID: " . $manager['user_id'] . "</option>";
            $selected = '';
          }
          $dbcon->close();
        } else {
          echo "<p>No managers founded</p>";
        }
      }
      ?>
    </select>
    <br>
    <button type="submit">Edit Location</button>
  </form>
</div>