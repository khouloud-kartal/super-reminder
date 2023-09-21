<?php

namespace App\view;

require_once('../../autoloader.php');

session_start();

$user = $_SESSION['user'];

use App\controller\WorkspaceController;
use App\controller\TablesController;

$table = new TablesController();

$workspace = new WorkspaceController();

$workspaceData = $workspace->getAllWorkspaceDataByUserId($user->getId());

if($_POST != NULL && isset($_GET['inscription'])){
    $table->addTable($_POST);
    echo $table->getMsg();
    die();
}

?>

<?php if(isset($_GET['listForm'])){ ?>
    
<form action="tables.php" method="post" id="tables">
    <fieldset>
        <legend>Add a List</legend>
        <br>
        <label for="title">Title</label>
        <input type="text" name="title" placeholder="Title" id="title">
        <br><br>
        <label for="description">Description</label>
        <textarea name="description" placeholder="Description" id="description"></textarea>
        <br><br>
        <select name="workspace">
            <?php foreach ($workspaceData as $title) { ?>
                <option value="<?= $title['id'];?>"><?= $title['title'];?></option>
            <?php }?>
        </select>
        <br><br>
        <button type="submit" name="submit" value="submit" id="btableForm">Add</button>

        <div id="message"></div>
    </fieldset>
</form>

<?php } ?>
