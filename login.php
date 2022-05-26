<?php
include("./pages/DBconfig.php");
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@400;500;700&display=swap" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/53a8c415f1.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./style/style_login.css?v=<?php echo time(); ?>" />
</head>

<body>
    <div class="wrap">
        <div class="login">
            <h2>LOG IN</h2>

            <form method="POST" class="login-form" action="<?php $_SERVER['PHP_SELF'] ?>">
                <div class="login_id">
                    <h4>User Name</h4>
                    <input type="email" name="userEmail" placeholder="Email" class="email" />
                </div>
                <div class="login_pw">
                    <h4>Password</h4>
                    <input type="password" name="userPassword" placeholder="Password" class="password" />
                </div>
                <div class="login_etc">
                    <div class="checkbox">
                        <input type="checkbox" name="checkbox" /> Remember Me?
                    </div>
                    <div class="forgot_pw">
                        <a href="">Forgot Password?</a>
                    </div>
                </div>
                <div class="submit">
                    <input type="submit" value="Login" />
                </div>
                <?php
                // FUNCTIONS
                // Input Check
                function Input_check($data)
                {
                    $data = trim($data);
                    $data = stripslashes($data);
                    $data = htmlspecialchars($data);
                    return $data;
                }
                // 

                // Conection to the data base and _SESSION variables
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $dbcon = new mysqli($DBserver, $username, $password, $dbName);
                    if ($dbcon->connect_error) {
                        die("Connection error: " . $dbcon->connect_error);
                    }
                    $email = Input_check($_POST['userEmail']);
                    $selectQuery = "SELECT * FROM users_tb WHERE user_email='$email'";
                    $result = $dbcon->query($selectQuery);

                    if ($result->num_rows == 1) {
                        $row = $result->fetch_assoc();

                        // Checking the salting
                        $pass = Input_check($_POST['userPassword']);
                        $salt = $row['salt'];
                        $hashedPass = $row['user_password'];
                        if (password_verify($pass . $salt, $hashedPass)) {
                            $_SESSION['userName'] = $row['first_name'];
                            $_SESSION['userRoll'] = $row['user_roll'];
                            $_SESSION['userID'] = $row['user_id'];
                            header('Location: ./index.php');
                            exit;
                        } else {
                            echo "<p>Wrong username/password</p>";
                        }
                    } else {
                        echo "<p>Wrong username/password</p>";
                    }
                    $dbcon->close();
                }
                ?>
            </form>
        </div>
    </div>
</body>

</html>