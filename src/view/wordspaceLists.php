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
<?php require_once('./includes/sideBar.php'); ?>

<main>
    <div id="tableList">
        <?php if($workspaceData){ ?> 
            <?php foreach ($data as $table){?>
        <div class="table" style="border: 2px solid black">
            <p>Title: <?= $table['title'] ?></p>
            <p>Description: <?= $table['description'] ?></p>
            <button id="addTask" value="<?= $table['id'] ?>">Add Task</button>
        </div>

        <?php } ?>
            <a href="./tables.php" class="w3-bar-item w3-button"><button id="addListBtn">Add a List</button></a>

        <?php }else{?>

            <p>This Work Space does not belong to you</p>

        <?php }?>
        
    </div>

    <div id="listForm">
        
    </div>
</main>
