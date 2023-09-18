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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="./scripts/script.js" defer></script>
    <title>Document</title>
</head>
<body>
    <main>
        
        <form action="signup.php" method="post" id="signup">
            <fieldset>
                <legend>Sign Up</legend>

                <label for="login">Login</label>
                <input type="text" name="login" placeholder="login" id="login">

                <label for="email">Email</label>
                <input type="email" name="email" id="email">

                <label for="password">Password</label>
                <input type="password" name="password" id="password">

                <label for="confirmPassword">Confirm Password</label>
                <input type="password" name="confirmPassword" id="confirmPassword">

                <button type="submit" name="submit" value="submit" id="signUp">Submit</button>
                
                <div id="message"></div>
            </fieldset>
        </form>
    </main>

</body>
</html>

