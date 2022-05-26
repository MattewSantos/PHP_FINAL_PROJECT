<?php
$dbCon = new mysqli($DBserver, $username, $password, $dbName);

if ($dbCon->connect_error) {
  die("DB error: " . $dbCon->connect_error);
} else {
  if (isset($_GET['UE'])) {
    $userId = $_GET['UE'];
    $selectQuery = "SELECT * FROM users_tb WHERE user_id='$userId'";
    $info = $dbCon->query($selectQuery);
    if ($info->num_rows == 1) {
      $info = $info->fetch_assoc();
      $userId = $info['user_id'];
      $userEmail = $info['user_email'];
      $userRoll = $info['user_roll'];
      $userFname = $info['first_name'];
      $userLname = $info['last_name'];
      $userAdd = $info['user_address'];
      $userPhone = $info['user_phone'];
    }
  }
}
$dbCon->close();
?>

<div class=editUserForm>
  <h3>Edit User</h3>
  <form method="POST" action="index?SE">
    <input type="text" name="ID" value="<?php echo $userId; ?>" readonly>
    <br>
    <input type="email" name="user_email" value="<?php echo $userEmail; ?>" require>
    <br>
    <select name="user_roll">
      <option value="manager" <?php if ($userRoll == 'manager') {
                                echo 'selected="selected"';
                              } ?>>Manager</option>
      <option value="customer" <?php if ($userRoll == 'customer') {
                                  echo 'selected="selected"';
                                } ?>>Client</option>
      <option value="super_admin" <?php if ($userRoll == 'super_admin') {
                                    echo 'selected="selected"';
                                  } ?>>Admin</option>
    </select>
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