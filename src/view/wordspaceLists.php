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

    </div>
        <div class="form-contener">
            <form action="tables.php" method="post" id="tables">
                <p><u>Add a List</u></p>

                <label for="title">Title</label>
                <input type="text" name="title" placeholder="Title" id="title">

                <label for="description">Description</label>
                <textarea name="description" placeholder="Description" id="description"></textarea>
                    <br>
                <button type="submit" name="submit" value="submit" id="btableForm">Add</button>

                <div id="message"></div>
            </form>
        </div>
</main>
