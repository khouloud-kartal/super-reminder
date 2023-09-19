<?php 

    namespace App\view;

    require_once('../../autoloader.php');

    use App\controller\TablesController;
    
    $table = new TablesController();

    // if($_POST != NULL && isset($_GET['inscription'])){
    //     $user->Register($_POST);
    //     echo $user->getMsg();
    //     die();  
    // }

    if(isset($_POST['submit'])){
        $table->register($_POST['title'], $_POST['description']);
    }


    
?>

<?php require_once('./includes/header.php'); ?>
    <main>
        
        <form action="tableForm.php" method="post" id="tableForm">
            <fieldset>
                <legend>Add a table</legend>

                <label for="title">Title</label>
                <input type="text" name="title" placeholder="Title" id="title">

                <label for="description">Description</label>
                <textarea type="text" name="description" placeholder="Description" id="description"></textarea>

                <button type="submit" name="submit" value="submit" id="btableForm">Submit</button>
                
                <div id="message"></div>
            </fieldset>
        </form>
    </main>

</body>
</html>