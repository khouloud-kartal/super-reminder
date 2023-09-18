<?php
    require_once('../../autoloader.php');

    use App\controller\UserController;

    session_start();

    if(!isset($_SESSION['user'])){
        header('location: index.php');
    }

    $user = new UserController();
    $user->disConnect();
?>
