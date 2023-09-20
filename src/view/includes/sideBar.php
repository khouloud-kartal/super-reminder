<?php

use App\controller\WorkspaceController;
use App\controller\TablesController;

$table = new TablesController();

$workspace = new WorkspaceController();


    $user = $_SESSION['user'];
    $workspaceDataById = $workspace->getAllWorkspaceDataByUserId($user->getId());
 



?>

<aside>
    <div class="w3-sidebar w3-bar-block w3-light-grey w3-card" style="width:160px;">
        <a href="#" class="w3-bar-item w3-button">Profil</a>
        <button class="w3-button w3-block w3-left-align" onclick="myAccFunc()">Work Spaces <i class="fa fa-caret-down"></i></button>
        <div id="demoAcc" class="w3-hide w3-white w3-card">
            <a href="./workSpace.php
            " class="w3-bar-item w3-button">Add a Work Space</a>
            <?php foreach ($workspaceDataById as $title) { ?>
                <a href="./workspaceLists.php?workspaceId=<?= $title['id'];?>&workspaceTitle=<?= $title['title'];?>" class="w3-bar-item w3-button"><?= $title['title'];?></a>
            <?php }?>

        </div>

        <div class="w3-dropdown-click">
            <button class="w3-button" onclick="myDropFunc()">Tables <i class="fa fa-caret-down"></i></button>
            <div id="demoDrop" class="w3-dropdown-content w3-bar-block w3-white w3-card">
            <a href="./tables.php" class="w3-bar-item w3-button">Add a table</a>
<!--            <a href="#" class="w3-bar-item w3-button">Link</a>-->
            </div>
        </div>
        <a href="#" class="w3-bar-item w3-button">Link 2</a>
        <a href="#" class="w3-bar-item w3-button">Link 3</a>
    </div>
</aside>