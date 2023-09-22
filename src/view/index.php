<?php

namespace App\view;

require_once('../../autoloader.php');

session_start();

$title = 'home';

?>

<?php require_once('./includes/header.php'); ?>

<?php 
if(isset($_SESSION['user'])){
    require_once('./includes/sideBar.php');
}
?>

<main>

</main>