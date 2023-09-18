<?php

namespace App\view;

require_once('../../autoloader.php');

session_start();

if($_POST != null && isset($_GET['inscription'])){
    $connect = new UserController();
    $connect->Connect($_POST);
    echo $connect->getMsg();
    die();  
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<body>
    <main>
        <form action="connexion.php" method="post" id="connexion">
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