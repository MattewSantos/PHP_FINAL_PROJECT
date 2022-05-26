<?php
  include('./header.php');
?>
<main>
  <!-- LEFT SECTION-->
  <section class="sidebar">
    <img src="./img/profile.jpg" alt="Profile Picture" class="profile">
    <?php
      echo "<h2>". $_SESSION['userName'] . "</h2>";
      echo "<h4>". $_SESSION['userRoll'] . "</h4>";
    ?>
    <nav>
      <ul>
        <?php
          include("./pages/". $_SESSION['userRoll']. "/list.php");
        ?>
      </ul>
    </nav>
  </section>

  <!-- RIGHT SECTION-->
  <section class="mainpage">
    <article class="header">
      <img src="./img/spaces.png" alt="Logo" class="logo">
      <form class="logout-form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input class="logout-btn" type="submit" name="logoutbtn" value="LogOut">
      </form>
    </article>
    <article class="main-content">
      <!-- Dynamic Content -->
      <?php
      /* Login out logic */
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
          if (isset($_POST['logoutbtn']) && $_POST['logoutbtn'] == "LogOut") {
            session_unset();
            session_destroy();
            header('Location: Login.php');
            exit;
          }
        }
        /* Side pages paginations */
        if (!isset($_GET['SA']) && !isset($_GET['m']) && !isset($_GET['c']))  {
          if (isset($_GET['UE']) || isset($_GET['DL']) || isset($_GET['SE']) || isset($_GET['DLL']) || isset($_GET['LE']) || isset($_GET['SEL']) || isset($_GET['DLS'])) {
            if (isset($_GET['UE'])) {include('./pages/super_admin/userEdit.php');}
            if (isset($_GET['DL']) || isset($_GET['SE'])) {include('./pages/super_admin/userEditMsg.php');}
            if (isset($_GET['LE'])) {include('./pages/super_admin/locationsEdit.php');}
            if (isset($_GET['DLL']) || isset($_GET['SEL'])) {include('./pages/super_admin/locationsEditMsg.php');}
            if (isset($_GET['DLS'])) {include('./pages/super_admin/create_spacesMsg.php');}
          } else {
            switch ($_SESSION['userRoll']) {
              case "super_admin";
                include('./pages/super_admin/dashboard.php');
                break;
              case "manager";
                include('./pages/manager/dashboard.php');
                break;
              case "customer";
                include('./pages/customer/dashboard.php');
                break;
            }
          }
        }

        /* Users links option pagination */
        if (isset($_GET['SA'])) {
          switch ($_GET['SA']) {
            case "1":
              include('./pages/super_admin/dashboard.php');
              break;
            case "2":
              include('./pages/super_admin/users.php');
              break;
            case "3":
              include('./pages/super_admin/locations.php');
              break;
            case "4":
              include('./pages/super_admin/create_spaces.php');
              break;
            case "5":
              include('./pages/super_admin/userNew.php');
              break;
            case "6":
              include('./pages/super_admin/locationsNew.php');
              break;
          }
        }
        if (isset($_GET['m'])) {
          switch ($_GET['m']) {
            case "1":
              include('./pages/manager/dashboard.php');
              break;
            case "2":
              include('./pages/manager/bookSpace.php');
              break;
            case "3":
              include('./pages/manager/users.php');
              break;
          }
        }
        if (isset($_GET['c'])) {
          switch ($_GET['c']) {
            case "1":
              include('./pages/customer/dashboard.php');
              break;
            case "2":
              include('./pages/customer/profile.php');
              break;
            case "3":
              include('./pages/customer/bookSpace.php');
              break;
          }
        }
      ?>
    </article>
  </section>
</main>
</body>

</html>