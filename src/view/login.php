<?php

namespace App\view;

use App\controller\UserController;

require_once('../../autoloader.php');

session_start();

if($_POST != null && isset($_GET['inscription'])){
    $connect = new UserController();
    $connect->Connect($_POST);
    echo $connect->getMsg();
    die();  
}
?>

<?php require_once('./includes/header.php'); ?>
    <main>
        <form action="login.php" method="post" id="login">
           
            <center>
                <legend>Sign In</legend>
                <br>
                <label for="email">Email</label>
                <input type="email" name="email" id="email">
                <br><br>

                <label for="password">Password</label>
                <input type="password" name="password" id="password">
                <br><br>
                <button type="submit" name="submit" value="submit">Submit</button>
                <br>
                <div id="message"></div>
            </center>
                <br>
            <center>
                <button type="submit" name="Inscription" value="Inscription">Inscription</button>
            </center>
        </form>
    </main>
</body>
</html>