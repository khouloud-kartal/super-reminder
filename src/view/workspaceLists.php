<?php

namespace App\view;

require_once('../../autoloader.php');

session_start();

$title = 'workspaces';

$user = $_SESSION['user'];

use App\controller\TablesController;
use App\controller\WorkspaceController;

$tables = new TablesController();
$workspace = new WorkspaceController();

$workspaceData = $workspace->checkWorkspaceExists($_SESSION['user']->getId(), $_GET['workspaceId']);

$_SESSION['WorkspaceId'] = $_GET['workspaceId'];

?>

<?php require_once('./includes/header.php'); ?>



<main id="tablesPage">

    <?php if($workspaceData){?>

    <h1><?=  $_GET['workspaceTitle'] ?></h1>

    <form action="tables.php" method="post" id="tables">
        <fieldset>
            <legend>Add a List</legend>

            <label for="title">Title</label>
            <input type="text" name="title" placeholder="Title" id="title">

            <label for="description">Description</label>
            <textarea name="description" placeholder="Description" id="description"></textarea>

            <button type="submit" name="submit" value="submit" id="btableForm">Add</button>

            <div id="message"></div>
        </fieldset>
    </form>

    <h2>My lists</h2>

    <div id="tableList">

    </div>

    <?php }else{ ?>

        <p>This Work Space does not belong to you</p>
    <?php } ?>

</main>
