<?php

namespace App\view;

require_once('../../autoloader.php');

session_start();

$user = $_SESSION['user'];

var_dump($user);

use App\controller\WorkspaceController;
use App\controller\TablesController;

$table = new TablesController();

$workspace = new WorkspaceController();




?>
<?php require_once('./includes/header.php'); ?>
<?php require_once('./includes/sideBar.php'); ?>

<main>
    <h1>Table</h1>

    <div id="lists">
        <div class="list">
            <div class="task">
                
            </div>
        </div>
    </div>
</main>
