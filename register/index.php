<?php

session_start();

require_once('../src/function.php');

$can_disp_msg = true;

//
// IF CONNECTED REDIRECT TO HOME PAGE
//
if ($_SESSION && isset($_SESSION['email'])) {
    header('Location: /');
}

//
// POST USER CREATION
//
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

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>S'inscrire</title>
</head>
<body>

<h1>S'inscrire</h1>

<?php $can_disp_msg ? html_message() : 0 ?>

<br>
<form method="post">
    <input type="text" name="lastname" placeholder="Nom">
    <br>
    <input type="text" name="firstname" placeholder="Prénom">
    <br>
    <input type="email" name="email" placeholder="Email">
    <br>
    <input type="password" name="password" placeholder="Mot de passe">
    <br>
    <input type="password" name="confirm_password" placeholder="Confirmation mot de passe">
    <br>
    <input type="submit">
</form>

</body>
</html>