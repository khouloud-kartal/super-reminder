<?php

require_once '../../autoloader.php';


if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="./scripts/script.js" defer></script>
    <title>Tasks</title>
</head>

<body>

<header>
    <nav>
        <a href="index.php">Home</a>
        <?php if (!isset($_SESSION['user'])){ ?><a href="login.php">Sign In</a><?php } ?>
        <?php if (!isset($_SESSION['user'])){ ?><a href="signup.php"><img src="css/images/inscription.png" style="width: 100px"></a><?php } ?>
        <?php if (isset($_SESSION['user'])){ ?><a href="profil.php">Profil</a><?php } ?>
        <?php if (isset($_SESSION['user'])){ ?><a href="disconnect.php">Disconnect</a><?php } ?>

    </nav>
</header>


<footer>


</footer>

</body>
