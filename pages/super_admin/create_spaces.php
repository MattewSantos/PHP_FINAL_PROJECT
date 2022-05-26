<h2>Spaces</h2>
<?php
$dbcon = new mysqli($DBserver, $username, $password, $dbName);
if ($dbcon->connect_error) {
    die("DB error");
} else {
    $selectQuery = "SELECT s.space_id,s.type,n.name FROM spaces_tb s INNER JOIN locations_tb n on s.location_id=n.location_id ORDER BY n.name, s.type";
    $spacesList = $dbcon->query($selectQuery);
    if ($spacesList->num_rows > 0) {
        echo "<table><tr><th>ID</th><th>Type</th><th>Location</th><th></th></tr>";
        while ($space = $spacesList->fetch_assoc()) {
            echo "<tr><td>" . $space['space_id'] . "</td><td>" . $space['type'] . "</td><td>" . $space['name'] . "</td><td><a href='index.php?DLS=" . $space['space_id'] . "'>Delete</a></tr>";
        }
        echo "</table>";
        $dbcon->close();
    } else {
        echo "<p>no locations founded</p>";
    }
}
?>

<h2>Create a space</h2>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $dbcon = new mysqli($DBserver, $username, $password, $dbName);
    if ($dbcon->connect_error) {
        die("Connection error: " . $dbcon->connect_error);
    }
    $name_space = $_POST['name_space'];
    $spaces_types = $_POST['spaces_types'];
    $select_location = $_POST['Select_location'];
    $insertQuery = "INSERT INTO spaces_tb(name,type,location_id) VALUES('$name_space','$spaces_types','$select_location')";
    if ($dbcon->query($insertQuery) === true) {
        echo "<p>Space was registered</p>";
        echo "<meta http-equiv='refresh' content='1'>";
    } else {
        echo "<p>Not submitted</p>";
    }
    $dbcon->close();
}
?>

<form method="POST">
    <input type="text" name="name_space" placeholder="Type the space name: ">
    <br>
    <select name="spaces_types" required>
        <option value="desk">Desk</option>
        <option value="office">Office</option>
        <option value="meeting_room">Meeting Room</option>
    </select>
    <h3>Select the location: </h3>
    <select name="Select_location" required>
        <?php
        $dbcon = new mysqli($DBserver, $username, $password, $dbName);
        if ($dbcon->connect_error) {
            die("DB error");
        } else {
            $selectQuery = "SELECT * FROM locations_tb";
            $LocationsList = $dbcon->query($selectQuery);
            if ($LocationsList->num_rows > 0) {
                while ($Loc = $LocationsList->fetch_assoc()) {
                    echo "<option value='" . $Loc['location_id'] . "'>" . $Loc['name'] . " " . $Loc['address'] . " " . $Loc['location_id'] . "</option>";
                }
                $dbcon->close();
            } else {
                echo "<p>No Locations founded</p>";
            }
        }
        ?>
    </select>
    <br>
    <button type="submit">Register Space</button>
</form>