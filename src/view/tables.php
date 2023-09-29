<?php

namespace App\view;

require_once('../../autoloader.php');

session_start();

$user = $_SESSION['user'];

use App\controller\WorkspaceController;
use App\controller\TablesController;

$table = new TablesController();

$workspace = new WorkspaceController();
// var_dump($_SESSION['WorkspaceId']);

if($_POST != NULL && isset($_GET['inscription'])){
    $table->addTable($_POST, $_SESSION['WorkspaceId']);
    $lists = $table->getListJson($_SESSION['WorkspaceId']);
    $lists[] = $table->getMsg();
    $json = json_encode($lists, JSON_PRETTY_PRINT);
    echo $json;
    die(); 
}


if(isset($_GET['DeleteList'])){
    $table->DeleteList($_GET['listId']);
    die();
}

if(isset($_GET['addMember'])){
    $workspace->addUserToWorkspace($_POST, $_SESSION['WorkspaceId']);
    echo $workspace->getMsg();
}


if(isset($_GET['displayMembers'])){
    $usersByWorkspace = $workspace->getMembersByWorkspace($_SESSION['WorkspaceId']);
    echo $usersByWorkspace;
    die();
}

