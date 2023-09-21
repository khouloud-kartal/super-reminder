<?php

namespace App\view;

require_once('../../autoloader.php');

session_start();

?>

<?php require_once('./includes/header.php'); ?>

<?php if(isset($_SESSION['user'])){
    require_once('./includes/sideBar.php');
}

?>

<main id="logo"> 
    <img id="logo" src="css/images/logoo.png";>
</main>



