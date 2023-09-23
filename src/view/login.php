<?php

namespace App\view;

use App\controller\UserController;

require_once('../../autoloader.php');

session_start();

$title = 'login';

var_dump($_POST);


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
            <fieldset>
                <legend>Sign In</legend>

                <label for="email">Email</label>
                <input type="email" name="email" id="email">

                <label for="password">Password</label>
                <input type="password" name="password" id="password">

                <button type="submit" name="submit" value="submit">Submit</button>

                <div id="message"></div>
            </fieldset>
        </form>
    </main>
</body>
</html>