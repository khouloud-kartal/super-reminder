<?php 

    namespace App\view;

    require_once('../../autoloader.php');

    session_start();

    $user = $_SESSION['user'];

    use App\controller\WorkspaceController;
    
    $workspace = new WorkspaceController();

     if($_POST != NULL && isset($_GET['inscription'])){
        $workspace->addWorkspace($_POST, $user->getId());
        echo $workspace->getMsg();
        die();
    }

    
?>

<?php require_once('./includes/header.php'); ?>
    <main>
<!--        --><?php //require_once('./includes/sideBar.php'); ?>
        <form action="workSpace.php" method="post" id="workSpace">
            <fieldset>
                <legend>Add a Work Space</legend>

                <label for="title">Title</label>
                <input type="text" name="title" placeholder="Title" id="title">

                <label for="description">Description</label>
                <textarea name="description" placeholder="Description" id="description"></textarea>

                <button type="submit" name="submit" value="submit" id="btableForm">Submit</button>
                
                <div id="message"></div>
            </fieldset>
        </form>
    </main>

</body>
</html>