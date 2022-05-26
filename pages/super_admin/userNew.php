<h2>Create a new user</h2>

<div class=newUsersForm>
  <form method="POST">
    <input type="email" name="user_email" placeholder="Type the user email: " require>
    <br>
    <input type="password" name="user_password" placeholder="Password" required>
    <br>
    <select name="user_roll">
      <option value="manager">Manager</option>
      <option value="customer">Client</option>
      <option value="super_admin">Admin</option>
    </select>
    <br>
    <input type="text" name="user_firstName" placeholder="Type user first name: " required>
    <br>
    <input type="text" name="user_lastName" placeholder="Type user last name: " required>
    <br>
    <input type="text" name="user_address" placeholder="Type user address: ">
    <br>
    <input type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="User_phone" placeholder="Type user phone number: ">
    <br>
    <button type="submit"> Register User</button>
  </form>
  <?php
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $dbcon = new mysqli($DBserver, $username, $password, $dbName);
    if ($dbcon->connect_error) {
      die("Connection error: " . $dbcon->connect_error);
    }
    $email = $_POST['user_email'];
    $userPass = $_POST['user_password'];
    $salt = time();
    $hashedPass = password_hash($userPass . $salt, PASSWORD_DEFAULT);
    $roll = $_POST['user_roll'];
    $fname = $_POST['user_firstName'];
    $lname = $_POST['user_lastName'];
    $address = $_POST['user_address'];
    $phone = $_POST['User_phone'];
    $insertQuery = "INSERT INTO users_tb(user_email,user_password,user_roll,first_name,last_name,salt,user_address,user_phone) VALUES
            ('$email','$hashedPass','$roll','$fname','$lname','$salt','$address','$phone')";
    if ($dbcon->query($insertQuery) === true) {
      echo "<p>User was registered</p>";
    } else {
      echo "<p>Not submitted</p>";
    }
    $dbcon->close();
  }
  ?>
</div>