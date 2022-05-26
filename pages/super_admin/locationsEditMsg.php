<!-- Delete location -->
<?php
$dbCon = new mysqli($DBserver, $username, $password, $dbName);
if (isset($_GET['DLL'])) {
  $locationId = $_GET['DLL'];
  $selectQuery = "SELECT * FROM spaces_tb WHERE location_id='$locationId'";
  $spacesInLoc = $dbCon->query($selectQuery);
  if ($spacesInLoc->num_rows > 0) {
    echo "<h3>There's spaces on the location. It's not possible to delete</h3>";
  } else {
    $deleteQuery = "DELETE FROM locations_tb WHERE location_id='$locationId'";
    if ($dbCon->query($deleteQuery) === true) {
      echo "<h3>The location ID " . $locationId . " has been deleted</h3>";
    }
  }

}
$dbCon->close();
?>

<!-- Edit Location -->
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $dbcon = new mysqli($DBserver, $username, $password, $dbName);
  if ($dbcon->connect_error) {
    die("Connection error: " . $dbcon->connect_error);
  }
  $locationId = $_POST['ID'];
  $name = $_POST['company_name'];
  $address = $_POST['company_address'];
  $manager = $_POST['select_manager'];
  $insertQuery = "UPDATE locations_tb SET name='$name', address='$address', manager_id='$manager' WHERE location_id='$locationId'";
  if ($dbcon->query($insertQuery) === true) {
    echo "<h3>Location ID " . $locationId . " was modified</h3>";
  } else {
    echo "<h3>Error</h3>";
  }
  $dbcon->close();
}
