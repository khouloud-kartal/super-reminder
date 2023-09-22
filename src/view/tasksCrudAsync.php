<?php

namespace App\view;

require_once('../../autoloader.php');

session_start();

$title = 'tasks';

$user = $_SESSION['user'];

// use App\controller\TablesController;
// use App\controller\WorkspaceController;
use App\controller\TaskController;

// var_dump($_GET);
// var_dump($_SESSION['listId']);

$tasks = new TaskController();

if($_POST != NULL && isset($_GET['AddTask'])){
    $tasks->addTask($_POST, $_SESSION['listId']);
    echo $tasks->getAllTasksJson($_SESSION['listId']);
    die();
}