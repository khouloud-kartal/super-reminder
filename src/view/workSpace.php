<?php 

    namespace App\view;

    require_once('../../autoloader.php');

    session_start();

    $title = 'workspace';

    $user = $_SESSION['user'];

    use App\controller\WorkspaceController;
    
    $workspace = new WorkspaceController();

    if($_POST != NULL && isset($_GET['display'])){
        // var_dump($_POST);
        $workspace->addWorkspace($_POST, $user->getId());
        $workspaceList = $workspace->getAllWorkspaceDataByUserId($user->getId());
        $workspaceList[] = $workspace->getMsg();
        $json = json_encode($workspaceList, JSON_PRETTY_PRINT);
        echo $json;
        die(); 
        
           
    }

    if(isset($_GET['DeleteWorkSpace'])){
        $workspace->DeleteWorkspace($_GET['workspaceId']);
        die();
    }

    
?>

<?php require_once('./includes/header.php'); ?>

    <main id="workspacePage">

        <form action="workSpace.php" method="post" id="workSpace">
            <fieldset>
                <legend>Add a Work Space</legend>

                <label for="title">Title</label>
                <input type="text" name="title" placeholder="Title" id="title">

                <label for="description">Description</label>
                <textarea name="description" placeholder="Description" id="description"></textarea>

                <button type="submit" name="submit" value="submit" id="bworkspaceForm">Submit</button>
                
                <div id="message"></div>

            </fieldset>
        </form>
    <h2>My Work Spaces</h2>
        
    <div id="workSpacesDiv"></div>
    

    </main>

    

</body>
</html>