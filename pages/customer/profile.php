<h2>Edit your profile</h2>
<?php
$dbCon = new mysqli($DBserver, $username, $password, $dbName);
$userId = $_SESSION['userID'];
if ($dbCon->connect_error) {
    die("DB error: " . $dbCon->connect_error);
} else {
        $selectQuery = "SELECT * FROM users_tb WHERE user_id='$userId'";
        $info = $dbCon->query($selectQuery);
        if ($info->num_rows == 1) {
            $info = $info->fetch_assoc();
            $userId = $info['user_id'];
            $userEmail = $info['user_email'];
            $userFname = $info['first_name'];
            $userLname = $info['last_name'];
            $userAdd = $info['user_address'];
            $userPhone = $info['user_phone'];
        }
}
$dbCon->close();
?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $dbcon = new mysqli($DBserver, $username, $password, $dbName);
  if ($dbcon->connect_error) {
    die("Connection error: " . $dbcon->connect_error);
  }
  $userId = $_POST['ID'];
  $email = $_POST['user_email'];
  $fname = $_POST['user_firstName'];
  $lname = $_POST['user_lastName'];
  $address = $_POST['user_address'];
  $phone = $_POST['User_phone'];
  $insertQuery = "UPDATE users_tb SET user_email='$email', first_name='$fname', last_name='$lname', user_address='$address', user_phone='$phone' WHERE user_id='$userId'";
  if ($dbcon->query($insertQuery) === true) {
    echo "<h3>User ID " . $userId . " was modified</h3>";
    $_SESSION['userName'] = $fname;
    echo "<meta http-equiv='refresh' content='2'>";
  } else {
    echo "<h3>Error</h3>";
  }
  $dbcon->close();
}
?>

<div class=editUserForm>
    <form method="POST" >
        <input type="text" name="ID" value="<?php echo $userId; ?>" readonly>
        <br>
        <input type="email" name="user_email" value="<?php echo $userEmail; ?>" require>
        <br>
        <input type="text" name="user_firstName" value="<?php echo $userFname; ?>" required>
        <br>
        <input type="text" name="user_lastName" value="<?php echo $userLname; ?>" required>
        <br>
        <input type="text" name="user_address" value="<?php echo $userAdd; ?>">
        <br>
        <input type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="User_phone" value="<?php echo $userPhone; ?>">
        <br>
        <button type="submit"> Edit User</button>
    </form>
</div>