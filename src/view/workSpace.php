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
<?php require_once('./includes/sideBar.php'); ?>
    <main>
           <?php //require_once('./includes/sideBar.php'); ?>
        <form action="workSpace.php" method="post" id="workSpace">

                <legend>Add a Work Space</legend>
                <br>
                <label for="title">Title</label>
                <input type="text" name="title" placeholder="Title" id="title">
                <br><br>
                <label for="description">Description</label>
                <textarea name="description" placeholder="Description" id="description"></textarea>
                <br><br>
                <button type="submit" name="submit" value="submit" id="btableForm">Submit</button>
                <br><br>
                <div id="message"></div>
        </form>
    </main>

</body>
</html>