<?php
$dbCon = new mysqli($DBserver, $username, $password, $dbName);
if (isset($_GET['DLS'])) {
  $spaceId = $_GET['DLS'];
  $time = date('Y-m-d H:i:s',time());
  $selectQuery = "SELECT * FROM schedule_tb A WHERE space_id='$spaceId' AND A.time > CONVERT('$time',datetime)";
  $spaceSche = $dbCon->query($selectQuery);
  if ($spaceSche->num_rows) {
    echo "<h3>This space is booked for an user</h3>";
    while ($space = $spaceSche->fetch_assoc()) {
      echo "<p>User id: ".$space['user_id']." time: ".$space['time']."</p>";
    }
  } else {
    $deleteQuery = "DELETE FROM schedule_tb WHERE space_id='$spaceId'";
    if ($dbCon->query($deleteQuery) === true) {
      echo "<h3>The space ID " . $spaceId . " has been deleted</h3>";
    }
  }
}
$dbCon->close();