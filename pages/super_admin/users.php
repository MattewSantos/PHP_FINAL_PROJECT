<h2>Users</h2>
<div class="usersList">
    <?php
        $dbCon = new mysqli($DBserver, $username, $password, $dbName);
      
        if ($dbCon->connect_error) {
            die("DB error: " . $dbCon->connect_error);
        } else {
            /* 
                // Message after the editing
                if (isset($_POST['productName']) && isset($_POST['productPrice'])) {
                    $newProctName = $_POST['productName'];
                    $newProductPrice = $_POST['productPrice'];
                    $productID = $_POST['productID'];
                    $updateQuery = "UPDATE product_tb SET productName='$newProctName', productPrice='$newProductPrice' WHERE productID=$productID";
                    if ($dbCon->query($updateQuery) === true) {
                        echo "<h2>Record updated</h2>";
                    } else {
                        echo "<h2>Record not updated" . $dbCon->error . "</h2>";
                    }
                }
                // After user deletion
                
            */
            $selectQuery = "SELECT * FROM users_tb";
            // If you want to order the output in decending use DESC keyword at the end.
            $users_list = $dbCon->query($selectQuery);
            if ($users_list->num_rows > 0) {
                echo "<table><tr><th>ID</th><th>First name</th><th>Last name</th><th>Roll</th><th>Email</th><th>Edit</th><th>Delete</th>";
                while ($user = $users_list->fetch_assoc()) {
                    echo "<tr><td>" . $user['user_id'] . "</td><td>" . $user['first_name'] . "</td><td>" . $user['last_name'] . "</td><td>" . $user['user_roll'] . "</td><td>" . $user['user_email'] . "</td><td><a href='index.php?UE=" . $user['user_id'] . "'>Edit</a></td><td><a href='index.php?DL=" . $user['user_id'] . "'>Delete</a></td></tr>";
                }
                echo "</table>";
            }
            $dbCon->close();
        }
    ?>
</div>

<h2><a class="button" href="index.php?SA=5">New user</a></h2>
