<h2>Locations designed</h2>

<div class="scheduleList">
  <?php
  $dbCon = new mysqli($DBserver, $username, $password, $dbName);
  if ($dbCon->connect_error) {
    die("DB error");
  } else {
    $managerId = $_SESSION['userID'];
    $time = date('Y-m-d H:i:s', time());
    $locationQuery = "SELECT * FROM locations_tb WHERE manager_id='$managerId'";
    $locations = $dbCon->query($locationQuery);
    if ($locations->num_rows > 0) {
      while ($location = $locations->fetch_assoc()) {
        echo "<h3>" . $location['name'] . "</h3>";
        $locationId = $location['location_id'];
        $scheludeQuery = $dbCon->query("SELECT `time`,`first_name`,`last_name`,`type`,S.location_id 
            FROM ((schedule_tb S
            INNER JOIN spaces_tb P on S.space_id=P.space_id)
            INNER JOIN users_tb U on S.user_id=U.user_id)
            WHERE S.location_id='$locationId' 
            AND time > CONVERT('$time',datetime)
            ORDER BY time");
        if ($scheludeQuery->num_rows > 0) {
          echo "<table><tr><th>Time</th><th>Client</th><th>type</th></tr>";
          while ($book = $scheludeQuery->fetch_array()) {
            echo "<tr><td>" . $book['time'] . "</td><td>" . $book['first_name'] . " " . $book['last_name'] . "</td><td>" . $book['type'] . "</td></tr>";
          }
          echo "</table>";
        } else {
          echo "<p>No booking yet</p>";
        }
      }
    } else {
      echo "<p>No managers founded</p>";
    }
    $dbCon->close();
  }
  ?>
</div>