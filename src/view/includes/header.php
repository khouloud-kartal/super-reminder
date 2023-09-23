<?php

require_once '../../autoloader.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <script src="./scripts/script.js" defer></script>
    <title><?= $title ?></title>
</head>
<body>

<div class="header"></div>
  <input type="checkbox" class="openSidebarMenu" id="openSidebarMenu">
  <label for="openSidebarMenu" class="sidebarIconToggle">
    <div class="spinner diagonal part-1"></div>
    <div class="spinner horizontal"></div>
    <div class="spinner diagonal part-2"></div>
  </label>
  <div id="sidebarMenu">
    <ul class="sidebarMenuInner">
      <li><a href="index.php">Tasks<span>Planner</span></a></li>
      <?php if (!isset($_SESSION['user'])){ ?><li><a href="login.php">Sign In</a></li><?php } ?>
      <?php if (!isset($_SESSION['user'])){ ?><li><a href="signup.php">Sign Up</a></li><?php } ?>
      <?php if (isset($_SESSION['user'])){ ?><li><a href="workSpace.php">Work Space</a></li><?php } ?>
      <?php if (isset($_SESSION['user'])){ ?><li><a href="profil.php">Profil</a></li><?php } ?>
      <?php if (isset($_SESSION['user'])){ ?><li><a href="disconnect.php">Disconnect</a></li><?php } ?>
    </ul>
  </div>


