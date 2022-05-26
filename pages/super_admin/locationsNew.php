<h3>New locations</h3>
<form method="POST">
  <input type="text" name="company_name" placeholder="Location Name: ">
  <br>
  <input type="text" name="company_address" placeholder="Location Address: " required>
  <br>
  <label for="select_manager">Choose the responsible manager for this location</label>
  <br>
  <select name="select_manager" required>
    <?php
    $dbcon = new mysqli($DBserver, $username, $password, $dbName);
    if ($dbcon->connect_error) {
      die("DB error");
    } else {
      $selectQuery = "SELECT * FROM users_tb WHERE user_roll='manager'";
      $ManagerList = $dbcon->query($selectQuery);
      if ($ManagerList->num_rows > 0) {
        while ($manager = $ManagerList->fetch_assoc()) {
          echo "<option value='" . $manager['user_id'] . "'>" . "  " . $manager['first_name'] . "  " . $manager['last_name'] . " ID: " . $manager['user_id'] . "</option>";
        }
        $dbcon->close();
      } else {
        echo "<p>No managers founded</p>";
      }
    }
    ?>
  </select>
  <br>
  <button type="submit">Register Location</button>
</form>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $dbcon = new mysqli($DBserver, $username, $password, $dbName);
  if ($dbcon->connect_error) {
    die("Connection error: " . $dbcon->connect_error);
  }
  $name = $_POST['company_name'];
  $address = $_POST['company_address'];
  $managerId = $_POST['select_manager'];
  $insertQuery = "INSERT INTO locations_tb(name,address,manager_id) VALUES('$name','$address','$managerId')";
  if ($dbcon->query($insertQuery) === true) {
    echo "<p>Location was registered</p>";
  } else {
    echo "<p>Not submitted</p>";
  }
  $dbcon->close();
}
?>