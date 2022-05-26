<h2>Locations</h2>
<!-- TABLE -->
<?php
$dbcon = new mysqli($DBserver, $username, $password, $dbName);
if ($dbcon->connect_error) {
    die("DB error");
} else {
    $selectQuery = "SELECT `location_id`,`name`,`address`,`first_name`,`last_name` FROM locations_tb INNER JOIN users_tb on users_tb.user_id=locations_tb.manager_id";
    $LocationsList = $dbcon->query($selectQuery);
    if ($LocationsList->num_rows > 0) {
        echo "<table><th>ID</th><th>Name</th><th>Address</th><th>Manager</th><th></th><th></th></tr>";
        while ($Loc = $LocationsList->fetch_assoc()) {
            echo "<tr><td>" . $Loc['location_id'] . "</td><td>" . $Loc['name'] . "</td>
                    <td>" . $Loc['address'] . "</td><td>" . $Loc['first_name'] . " " . $Loc['last_name'] . "</td>" . "</td><td><a href='index.php?LE=" . $Loc['location_id'] . "'>Edit</a></td><td><a href='index.php?DLL=" . $Loc['location_id'] . "'>Delete</a></tr>";
        }
        echo "</table>";
        $dbcon->close();
    } else {
        echo "<p>no locations founded</p>";
    }
}
?>

<h2><a class="button" href="index.php?SA=6">New Location</a></h2>