<h2>Agenda</h2>

<div class="scheduleList">
  <?php
  $dbCon = new mysqli($DBserver, $username, $password, $dbName);
  if ($dbCon->connect_error) {
    die("DB error");
  } else {
    $customerId = $_SESSION['userID'];
    $time = date('Y-m-d H:i:s', time());
    $scheludeQuery = "SELECT `time`,L.name,`type`,S.location_id, U.user_id
      FROM (((schedule_tb S
      INNER JOIN spaces_tb P on S.space_id=P.space_id)
      INNER JOIN locations_tb L on S.location_id=L.location_id)
      INNER JOIN users_tb U on S.user_id=U.user_id)
      WHERE S.user_id='$customerId'
      AND time > CONVERT('$time',datetime)
      ORDER BY time";
    $bookList = $dbCon->query($scheludeQuery);
    if ($bookList->num_rows > 0) {
      echo "<table><tr><th>Time</th><th>Location</th><th>type</th></tr>";
      while ($book = $bookList->fetch_assoc()) {
        echo "<tr><td>" . $book['time'] . "</td><td>" . $book['name'] . "</td><td>" . $book['type'] . "</td></tr>";
      }
      echo "</table>";
    } else {
      echo "<p>No schedules yet<P>";
    }
    $dbCon->close();
  }
  ?>
</div>