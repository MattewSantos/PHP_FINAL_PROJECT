<div class="measure-cont">
  <div class="measure one">
    <h3>
      <?php
      $dbCon = new mysqli($DBserver, $username, $password, $dbName);
      if ($dbCon->connect_error) {
        die('Error');
      } else {
        $query = $dbCon->query('SELECT * FROM locations_tb');
        echo $query->num_rows;
      }
      $dbCon->close();
      ?>
    </h3>
    <h2>Locations</h2>
  </div>
  <div class="measure two">
    <h3>
      <?php
      $dbCon = new mysqli($DBserver, $username, $password, $dbName);
      if ($dbCon->connect_error) {
        die('Error');
      } else {
        $query = $dbCon->query('SELECT `user_id` FROM `users_tb` WHERE user_roll="customer"');
        echo $query->num_rows;
      }
      $dbCon->close();
      ?>
    </h3>
    <h2>Clients</h2>
  </div>
  <div class="measure three">
    <h3>
      <?php
      $dbCon = new mysqli($DBserver, $username, $password, $dbName);
      if ($dbCon->connect_error) {
        die('Error');
      } else {
        $query = $dbCon->query('SELECT * FROM schedule_tb');
        echo $query->num_rows;
      }
      $dbCon->close();
      ?>
    </h3>
    <h2>Booked Hours</h2>
  </div>
</div>

<div class="location-list">
<?php
  $dbCon = new mysqli($DBserver, $username, $password, $dbName);
  if ($dbCon->connect_error) {
    die("DB error");
  } else {
    $locationQuery = "SELECT * FROM locations_tb";
    $locations = $dbCon->query($locationQuery);
    if ($locations->num_rows > 0) {
      while ($location = $locations->fetch_assoc()) {
        echo "<h3>". $location['name']. " - ". $location['address'];
        $locationId = $location['location_id'];
        $deskQuery = $dbCon->query("SELECT * FROM spaces_tb WHERE location_id='$locationId' AND type='desk'");
        $officeQuery = $dbCon->query("SELECT * FROM spaces_tb WHERE location_id='$locationId' AND type='office'");
        $MRQuery = $dbCon->query("SELECT * FROM spaces_tb WHERE location_id='$locationId' AND type='meeting_room'");
        echo "
        <ul>
          <li>". $deskQuery->num_rows. " desk.". "</li>
          <li>" . $officeQuery->num_rows . " oficce." . "</li>
          <li>" . $MRQuery->num_rows . " meeting room." . "</li>
        </ul>
        ";
      }
    } else {
      echo "<p>No managers founded</p>";
    }
    $dbCon->close();
  }
?>
</div>