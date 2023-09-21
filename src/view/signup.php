<?php 

    namespace App\view;

    require_once('../../autoloader.php');

    use App\controller\UserController;
    
    $user = new UserController();

    if($_POST != NULL && isset($_GET['inscription'])){
        $user->Register($_POST);
        echo $user->getMsg();
        die();  
    }


    
?>

<?php require_once('./includes/header.php'); ?>
<?php require_once('./includes/sideBar.php'); ?>
    <main>
        
        <form action="signup.php" method="post" id="signup">
            <fieldset>
                <legend>Sign Up</legend>
                <br>

                <label for="login">Login</label>
                <input type="text" name="login" placeholder="login" id="login">
                <br><br>

                <label for="email">Email</label>
                <input type="email" name="email" placeholder="email" id="email">
                <br><br>

                <label for="password">Password</label>
                <input type="password" name="password" placeholder="password" id="password">
                <br><br>

                <label for="confirmPassword">Confirm Password</label>
                <input type="password" name="confirmPassword" placeholder="confirmation"  id="confirmPassword">
                <br><br>

                <button type="submit" name="submit" value="submit" id="signUp">Submit</button>
                <br><br>

                <div id="message"></div>
            </fieldset>
        </form>
    </main>

</body>
</html>

