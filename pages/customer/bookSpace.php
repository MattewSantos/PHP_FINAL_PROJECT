<h2>Book a space</h2>

<form method="POST">
  <label for="from">Client:</label>
  <br>
  <input type="text" name="userName" value="<?php echo $_SESSION['userName'] ?>" readonly>
  <br>
  <label for="location">Select a location:</label>
  <br>
  <select name="location" required>
    <?php
    $dbcon = new mysqli($DBserver, $username, $password, $dbName);
    if ($dbcon->connect_error) {
      die("DB error");
    } else {
      $selectQuery = "SELECT * FROM locations_tb";
      $LocationsList = $dbcon->query($selectQuery);
      if ($LocationsList->num_rows > 0) {
        while ($location = $LocationsList->fetch_assoc()) {
          echo "<option value='" . $location['location_id'] . "'>" . $location['name'] . " / " . $location['address'] . "</option>";
        }
        $dbcon->close();
      } else {
        echo "<p>The space is not available at this time, try another one or a different space.<p/>";
      }
    }
    ?>
  </select>
  <br>
  <label for="spaceType">Select a space type:</label>
  <br>
  <select name="spaceType" required>
    <!-- Values of the spaces -->
    <option value="1">Desk</option>
    <option value="2">Office</option>
    <option value="3">Meeting Room</option>
  </select>
  <br>
  <label for="day">Select the day:</label>
  <br>
  <input type="date" name="day" placeholder="type the day: " require>
  <br>
  <label for="time">Select the time:</label>
  <br>
  <select name="time" required>
    <option value="7">7:00</option>
    <option value="8">8:00</option>
    <option value="9">9:00</option>
    <option value="10">10:00</option>
    <option value="11">11:00</option>
    <option value="12">12:00</option>
    <option value="13">13:00</option>
    <option value="14">14:00</option>
    <option value="15">15:00</option>
    <option value="16">16:00</option>
    <option value="17">17:00</option>
    <option value="18">18:00</option>
    <option value="19">19:00</option>
    <option value="20">20:00</option>
    <option value="21">21:00</option>
    <option value="22">22:00</option>
  </select>
  <br>
  <button type="submit">Book Space</button>
</form>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $dbcon = new mysqli($DBserver, $username, $password, $dbName);
  if ($dbcon->connect_error) {
    die("Connection error: " . $dbcon->connect_error);
  }
  $userId = $_SESSION['userID'];
  $locationId = $_POST['location'];
  $spaceId = $_POST['spaceType'];
  $time = $_POST['day']. " ". $_POST['time']. ":00";
  //VALIDATE THE AVAILABILITY **DATE** OF THE **SPACE** IN THE **LOCATION**
  $insertQuery = "INSERT INTO schedule_tb(user_id, location_id, space_id, time) VALUES('$userId','$locationId','$spaceId', '$time')";
  if ($dbcon->query($insertQuery) === true) {
    echo "<p>Space booked succesfully<p/>";
  } else {
    echo "<p>Not submitted<p>";
  }
  $dbcon->close();
}
?>