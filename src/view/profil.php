<?php
namespace App\view;

require_once('../../autoloader.php');

use App\controller\UserController;

session_start();

$user = $_SESSION['user'];

if($_POST != NULL && isset($_GET['inscription'])){
    $users = new UserController();
    $users->Update($_POST);
    echo $users->getMsg();
    die();
}

?>

<?php require_once('./includes/header.php'); ?>
<?php require_once('./includes/sideBar.php'); ?>
    <main>
        <form action="profil.php" method="post" id="profil">

            <u>Profil</u>
            <br><br>
            <label for="login">Login</label>
            <input type="text" name="login" id="login" value="<?= $user->getLogin() ?>">
            <br><br>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="<?= $user->getEmail() ?>">
            <br><br>
            <label for="password">Password</label>
            <input type="password" name="password" id="password">
            <br><br>
            <label for="newPassword">New Password</label>
            <input type="password" name="newPassword" id="newPassword">
            <br><br>
            <label for="confirmNewPassword">Confirm New Password</label>
            <input type="password" name="confirmNewPassword" id="confirmNewPassword">
            <br><br>
            <button type="submit" name="submit" value="submit">Submit</button>
            <div id="message"></div>

        </form>
    </main>
</body>
</html>