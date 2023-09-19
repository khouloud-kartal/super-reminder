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

<?php require_once('./includes/header.php'); ?>
<main>
    <!--        --><?php //require_once('./includes/sideBar.php'); ?>
    <form action="tables.php" method="post" id="tables">
        <fieldset>
            <legend>Add a Tables</legend>

            <label for="title">Title</label>
            <input type="text" name="title" placeholder="Title" id="title">

            <label for="description">Description</label>
            <textarea name="description" placeholder="Description" id="description"></textarea>

            <select name="workspace">
                <?php foreach ($workspaceData as $title) { ?>
                    <option value="<?= $title['id'];?>"><?= $title['title'];?></option>
                <?php }?>
            </select>

            <button type="submit" name="submit" value="submit" id="btableForm">Submit</button>

            <div id="message"></div>
        </fieldset>
    </form>
</main>

</body>
</html>