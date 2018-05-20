<?php

session_start();

require_once('../src/function.php');
need_install();

$can_disp_msg = true;


// IF CONNECTED REDIRECT TO HOME PAGE
if (user_is_connected()) {
    header('Location: /');
}

//--------------------------------------------------------------
//
// POST registration validation, here to insert user
//
//--------------------------------------------------------------
if ($_POST) {
    $msg = '';
    if (!is_string($msg = user_is_valid_register()) && $msg) {
        $user = user_from_post();
        users_insert($user);
        set_success_message('Vous vous êtes bien enregistré, connectez-vous !');
        $can_disp_msg = false;
        header('Location: /login/');
    } else set_error_message($msg);
}

?>

<?php
include '../public/navbar.php';
html_header('S\'inscrire') ?>

<?php $can_disp_msg ? html_message() : 0 ?>

<br>
<form method="post">
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
    <input type="submit">
</form>

<?php html_footer() ?>