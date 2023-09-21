<?php

namespace App\view;

require_once('../../autoloader.php');

session_start();

?>

<?php require_once('./includes/header.php'); ?>

<?php 
if(isset($_SESSION)){
    require_once('./includes/sideBar.php');
}
?>

<main>

</main>