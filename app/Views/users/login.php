<?php
if(!empty($_POST)) {
    if($auth->auth($_POST['username'], $_POST['password'], 'App\Entities\UsersEntity')) {
        App\Response::loggedIn();
    } else {
?>
        <p style="color:red;">Identifiants incorrects.</p>
<?php
    }
}
?>

<form method="post">
    <label for="Nom d'utilisateur : "><input type="text" name="username"></label>
    <label for="Mot de passe : "><input type="password" name="password"></label>
    <input type="submit" value="Se connecter">
</form>