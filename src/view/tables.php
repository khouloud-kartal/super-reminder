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
    // echo $table->getMsg();
    echo $lists;
    die();
}


