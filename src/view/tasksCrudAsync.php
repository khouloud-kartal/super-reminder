<?php

namespace App\view;

require_once('../../autoloader.php');

session_start();

$user = $_SESSION['user'];

// use App\controller\TablesController;
// use App\controller\WorkspaceController;
use App\controller\TaskController;

$tasks = new TaskController();


// var_dump($_SESSION);


if($_POST != NULL && isset($_GET['inscription'])){
    $tasks->addTask($_POST, $_SESSION['listId']);
    die();
}

?>