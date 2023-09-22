<?php

namespace App\view;

require_once('../../autoloader.php');

session_start();

$title = 'tasks';

$user = $_SESSION['user'];

// use App\controller\TablesController;
// use App\controller\WorkspaceController;
use App\controller\TaskController;


$_SESSION['listId'] = $_GET['listId'];

$tasks = new TaskController();

// if($_POST != NULL && isset($_GET['AddTask'])){

//     $tasks->addTask($_POST, $_SESSION['listId']);
//     echo $tasks->getAllTasksJson($_SESSION['listId']);
//     die();
// }


?>

<?php require_once('./includes/header.php'); ?>

<main>
    <form action="tasksCrudAsync.php" method="post" id="tasks">
        <fieldset>
            <legend>Add a task</legend>

            <label for="title">Title</label>
            <input type="text" name="title">

            <label for="description">Description</label>
            <input type="text" name="description">

            <label for="color">Color</label>
            <input type="color" name="color">

            <button type="submit" name="submit" value="submit">Add</button>
        </fieldset>


    </form>
    <div>
        <h2>To Do</h2>
        <div id="todo">
            <!-- <p>Task1</p>
            <p>secription</p> 
            <div>
                <button>In progress</button>
                <button>delete</button>
            </div> -->
                
        </div>
    </div>

    <div>
        <h2>In progress</h2>
        <!-- <ul>
            <li>Task 1 
                <div>
                    <button>To Do</button>
                    <button>Done</button>
                    <button>delete</button>
                </div>
            </li>
        </ul> -->
        <p>Task1</p>
        <p>secription</p> 
        <div>
            <button>In progress</button>
            <button>delete</button>
        </div>
    </div>

    <div>
        <h2>Done</h2>
        <ul>
            <li>Task 1 
                <div>
                    <button>To Do</button>
                    <button>In Progress</button>
                    <button>delete</button>
                </div>
            </li>
        </ul>
    </div>
</main>