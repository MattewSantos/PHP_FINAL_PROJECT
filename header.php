<?php
include("./pages/DBconfig.php");
session_start();
if (!isset($_SESSION['first_name']) && !isset($_SESSION['userRoll'])) {
  session_destroy();
  header('Location: ./login.php');
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- cache fix -->
  <meta http-equiv="Expires" content="0">
  <meta http-equiv="Last-Modified" content="0">
  <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
  <meta http-equiv="Pragma" content="no-cache">

  <title>Spaces</title>
  <link rel="stylesheet" href="./style/style.css?v=<?php echo time(); ?>" />
</head>

<body>