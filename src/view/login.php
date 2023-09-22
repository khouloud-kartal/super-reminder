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
        <div class="form-contener">
            <form action="login.php" method="post" id="login">

                <FONT size="5pt">
                <div Align=Center><p><u>Sign In</u></p> </div>

                <label for="email">Email</label> 
                <input type="email" name="email" id="email">

                <label for="password">Password</label>
                <input type="password" name="password" id="password"></FONT>

                <br> 
                <FONT size="5pt">
                <div Align=Center> <button type="submit" name="submit" value="submit">Submit</button> </div>
                <div id="message"></div></FONT>
            
                <!-- <button type="submit" name="Inscription" value="Inscription">Inscription</button> METTRE UN LIEN A LA PLACE -->
            </form>
        </div>


    </main>
</body>
</html>