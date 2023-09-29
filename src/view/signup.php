<?php 

    namespace App\view;

    require_once('../../autoloader.php');

    use App\controller\UserController;
    
    $user = new UserController();

    $title = 'signup';

    if($_POST != NULL && isset($_GET['inscription'])){
        $user->Register($_POST);
        echo $user->getMsg();
        die();  
    }


    
?>

<?php require_once('./includes/header.php'); ?>
    <main id="signupPage">
        
        <form action="signup.php" method="post" id="signup">
            <fieldset>
                <legend>Sign Up</legend>

                <label for="login">Login</label>
                <input type="text" name="login" placeholder="login">

                <label for="email">Email</label>
                <input type="email" name="email" id="email">

                <label for="password">Password</label>
                <input type="password" name="password" id="password">

                <label for="confirmPassword">Confirm Password</label>
                <input type="password" name="confirmPassword" id="confirmPassword">

                <button type="submit" name="submit" value="submit" id="signUp">Submit</button>
                
                <p>Password must contain at least eight characters, at least one number and both lower and uppercase letters and special characters</p>

                <div id="message"></div>
            </fieldset>
        </form>
    </main>

</body>
</html>

