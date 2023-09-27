<?php

namespace App\view;

require_once('../../autoloader.php');

session_start();

$title = 'tasks';

$user = $_SESSION['user'];

use App\controller\TablesController;
// use App\controller\WorkspaceController;
use App\controller\TaskController;


$_SESSION['listId'] = $_GET['listId'];

$tasks = new TaskController();
$list = new TablesController();

$checkListId = $list->checkListId($user->getId(), $_GET['listId']);

// var_dump($checkListId);

?>

<?php require_once('./includes/header.php'); ?>

<main id ="tasksPage">

    <?php if($checkListId) {?>

    <form action="tasksCrudAsync.php" method="post" id="tasks">
        <fieldset>
            <legend>Add a task</legend>

            <label for="title">Title</label>
            <input type="text" name="title">

            <label for="description">Description</label>
            <input type="text" name="description">

            <label for="color">Color</label>
            <input type="color" name="color">

            <label for="tags">Tags</label>
            <select name="tags" id="tagsSelect">
                <option value="urgent">Urgent</option>
            </select>


            <label for="finDate">Fin Date</label>
            <input type="date" name="finDate">

            <button type="submit" name="submit" value="submit" id="addtaskbtn">Add</button>
    
        </fieldset>


    </form>

    <button id="openPopup">Add a tag</button>

    <div id="popupContainer" class="popup">
        <div class="popup-content">
            <span class="close" id="closePopup">&times;</span>
            <h2>Add a tag</h2>
            <form method="post" action="tasksCrudAsync.php" id="tags">

                <label for="name">Name</label>
                <input type="text" name="name">

                <div id="emojie">
                    <label for="food">&#127859;</label>
                    <input type="radio" name="emoji" value="&#127859;">

                    <label for="game">&#127918;</label>
                    <input type="radio" name="emoji" value="&#127918;">

                    <label for="sport">&#127939;</label>
                    <input type="radio" name="emoji" value="&#127939;">

                    <label for="home">&#127968;</label>
                    <input type="radio" name="emoji" value="&#127968;">

                    <label for="work">&#128188;</label>
                    <input type="radio" name="emoji" value="&#128188;">

                </div>
                
                <button type="submit" id="addTag">Add</button>

            </form>
        </div>
    </div>


    

    <div id="displayTasksDiv">

        <h2>My Tasks</h2>

        <div>
            <h3>To Do</h3>
            <div id="todo">
                
            </div>
        </div>

        <div>
            <h3>In progress</h3>
            <div id="progress">

            </div>
        </div>

        <div>
            <h3>Done</h3>
            <div id="done">

            </div>
        </div>

    </div>

    <?php }else{ ?>
        <p>This list does not belongs to you</p>
    <?php } ?>
</main>