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
    if (($msg = user_is_valid())) {
        echo $msg;
        $user = user_from_post();
        articles_insert($user);
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

<form action="POST">
    <input type="text"  name="lastname" placeholder="Nom">
    <input type="text"  name="firstname" placeholder="Prénom">
    <input type="email"  name="email" placeholder="Email">
    <input type="password"  name="password" placeholder="Mot de passe">
    <input type="password"  name="confirm_password" placeholder="Confirmation mot de passe">
    <input type="submit">
</form>

</body>
</html>