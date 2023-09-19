<?php

namespace App\view;

require_once('../../autoloader.php');

session_start();

$user = $_SESSION['user'];

use App\controller\TablesController;
use App\controller\WorkspaceController;

$tables = new TablesController();
$workspace = new WorkspaceController();

$workspaceData = $workspace->checkTablesExists($_SESSION['user']->getId(), $_GET['workspaceId']);

$data = $tables->GetTablesByWorkspaceId($_GET['workspaceId']);

?>

<?php require_once('./includes/header.php'); ?>


<main>
    <div id="tableList">
        <?php if($workspaceData > 0){ foreach ($data as $table){?>
        <a href="./tableList.php?table"><div class="table" style="border: 2px solid black">
            <p>Title: <?= $table['title'] ?></p>
            <p>Description: <?= $table['description'] ?></p>
        </div></a>

        <?php }}else{?>
        <p>This Work Space does not belong to you</p>

        <?php }?>
    </div>
</main>
