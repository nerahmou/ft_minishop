<?php

require_once '../src/function.php';

if (conf_is_created()) header('Location: /');

if ($_POST && !conf_is_created()) {
    if (!is_string($msg = config_is_valid_creation()) && $msg) {
        $user = config_creator_post();
        $_SESSION['email'] = $user['email'];
        header('Location: /');
    } else set_error_message($msg);
}


html_header('Installation');
html_message();

?>

<form method="post">
    <h3>Utilisateur admin</h3>
    <label for="lastname">Nom</label><br>
    <input type="text" name="lastname" placeholder="Nom">
    <br>
    <label for="firstname">Prénom</label><br>
    <input type="text" name="firstname" placeholder="Prénom">
    <br>
    <label for="email">Email</label><br>
    <input type="email" name="email" placeholder="Email">
    <br>
    <label for="password">Mot de passe</label><br>
    <input type="password" name="password" placeholder="Mot de passe">
    <br>
    <label for="confirm_password">Confirmation mot de passe</label><br>
    <input type="password" name="confirm_password" placeholder="Confirmation mot de passe">
    <br>
    <h3>Configuration du site</h3>
    <label for="name_website">Nom</label><br>
    <input type="text" name="name_website" placeholder="Nom du site">
    <br>
    <label for="currency_website">Devise</label><br>
    <input type="text" name="currency_website" placeholder="Devise (Symbol)">
    <br>
    <br>
    <input type="submit" value="Validation">
</form>

<?php html_footer() ?>
