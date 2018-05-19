<?php

session_start();

require_once('../src/function.php');

// IF CONNECTED REDIRECT TO HOME PAGE
if ($_SESSION && isset($_SESSION['email'])) {
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

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Se connecter</title>
</head>
<body>

<h1>Se connecter</h1>

<?php html_message() ?>

<br>
<form method="post">
    <input type="email" name="email" placeholder="Email">
    <br>
    <input type="password" name="password" placeholder="Mot de passe">
    <br>
    <input type="submit">
</form>

</body>
</html>
