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
        <div class="form-contener">
            <form action="profil.php" method="post" id="profil">

                <p><u>Profil</u><p>

                <label for="login">Login</label>
                <input type="text" name="login" id="login" value="<?= $user->getLogin() ?>">

                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="<?= $user->getEmail() ?>">

                <label for="password">Password</label>
                <input type="password" name="password" id="password">

                <label for="newPassword">New Password</label>
                <input type="password" name="newPassword" id="newPassword">

                <label for="confirmNewPassword">Confirm New Password</label>
                <input type="password" name="confirmNewPassword" id="confirmNewPassword">

                <button type="submit" name="submit" value="submit">Submit</button>
                <div id="message"></div>

            </form>
        </div>

    </main>
</body>
</html>