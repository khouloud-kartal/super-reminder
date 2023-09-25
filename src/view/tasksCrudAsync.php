<?php

namespace App\view;

require_once('../../autoloader.php');

session_start();

$title = 'tasks';

$user = $_SESSION['user'];


use App\controller\TaskController;

$tasks = new TaskController();

if($_POST != NULL && isset($_GET['AddTask'])){
    $tasks->addTask($_POST, $_SESSION['listId']);
    echo $tasks->getAllTasksJson($_SESSION['listId']);
    die();
}

if(isset($_GET['ChangeState']) && ($_GET['state'] === 'done' || $_GET['state'] === 'todo' || $_GET['state'] === 'progress')){
    $tasks->updateState($_GET['taskId'], $_GET['state']);
    die();
}

if(isset($_GET['DeleteTask'])){
    $tasks->DeleteTask($_GET['taskId']);
    die();
}

if($_POST != NULL && isset($_GET['display'])){
    $tasks->addTags($_POST, $user->getId());
    echo $tasks->getAllTagsJson($user->getId());
    die();
}
