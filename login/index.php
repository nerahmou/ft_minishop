<?php

session_start();

require_once('../src/function.php');

// IF CONNECTED REDIRECT TO HOME PAGE
if (user_is_connected()) {
    header('Location: /');
}

//--------------------------------------------------------------
//
// POST login validation, here insert user in session
//
//--------------------------------------------------------------
if ($_POST) {
    $msg = '';
    if (!is_string($msg = user_is_valid_login()) && $msg) {
        $_SESSION['email'] = $_POST['email'];
        header('Location: /');
    } else set_error_message($msg);
}
?>

<?php html_header('Se connecter') ?>

<?php html_message() ?>

<br>
<form method="post">
    <label for="email">Email</label> <br>
    <input type="email" name="email" placeholder="Email">
    <br>
    <label for="password">Mot de passe</label> <br>
    <input type="password" name="password" placeholder="Mot de passe">
    <br>
    <input type="submit">
</form>

<?php html_footer() ?>