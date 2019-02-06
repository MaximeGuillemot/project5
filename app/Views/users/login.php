<?php
if(!empty($_POST)) {
    

    if($auth->auth($_POST['username'], $_POST['password'])) {
        die('Connecté');
    } else {
        die('Pas co');
    }



}
?>

<form method="post">
    <label for="Nom d'utilisateur : "><input type="text" name="username"></label>
    <label for="Mot de passe : "><input type="password" name="password"></label>
    <input type="submit" value="Se connecter">
</form>