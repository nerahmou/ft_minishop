<?php

session_start();
ob_start();

require_once('../src/function.php');
require_once('../src/services/users_service.php');

//
// POST USER CREATION
//
if ($_POST) {
    $msg = '';
    if (!is_string($msg = user_is_valid()) && $msg) {
        $user = user_from_post();
        users_insert($user);
        set_success_message('Vous vous êtes bien enregistré, connectez-vous !');
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

<?php html_message() ?>

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