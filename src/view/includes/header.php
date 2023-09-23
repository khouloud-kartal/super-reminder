<?php

require_once '../../autoloader.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

use App\controller\WorkspaceController;
use App\controller\TablesController;

$table = new TablesController();

$workspace = new WorkspaceController();

$user = $_SESSION['user'];
$workspaceInfos = $workspace->getAllWorkspaceDataByUserId($user->getId());

 



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="./scripts/script.js" defer></script>
    <title><?= $title ?></title>
</head>
<body>
<!-- <header>
    <nav>
        <a href="index.php">Home</a>
        <?php if (!isset($_SESSION['user'])){ ?><a href="login.php">Sign In</a><?php } ?>
        <?php if (!isset($_SESSION['user'])){ ?><a href="signup.php">Sign Up</a><?php } ?>
        <?php if (isset($_SESSION['user'])){ ?><a href="profil.php">Profil</a><?php } ?>
        <?php if (isset($_SESSION['user'])){ ?><a href="disconnect.php">Disconnect</a><?php } ?>

    </nav>
</header> -->

<div class="header"></div>
  <input type="checkbox" class="openSidebarMenu" id="openSidebarMenu">
  <label for="openSidebarMenu" class="sidebarIconToggle">
    <div class="spinner diagonal part-1"></div>
    <div class="spinner horizontal"></div>
    <div class="spinner diagonal part-2"></div>
  </label>
  <div id="sidebarMenu">
    <ul class="sidebarMenuInner">
      <li>Jelena Jovanovic <span>Web Developer</span></li>
      <li><a href="index.php">Home</a></li>
      <?php if (!isset($_SESSION['user'])){ ?><li><a href="login.php">Sign In</a></li><?php } ?>
      <?php if (!isset($_SESSION['user'])){ ?><li><a href="signup.php">Sign Up</a></li><?php } ?>
      <?php if (isset($_SESSION['user'])){ ?><li><a href="workSpace.php">Work Space</a></li><?php } ?>
      <?php if (isset($_SESSION['user'])){ ?><li><a href="profil.php">Profil</a></li><?php } ?>
      <?php if (isset($_SESSION['user'])){ ?><li><a href="disconnect.php">Disconnect</a></li><?php } ?>
    </ul>
  </div>

