<?php

session_start();

require_once 'src/services/users_service.php';
require_once 'src/function.php';

?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
</head>
<body>

<?php if (!user_is_connected()) { ?>
<li><a href="/register/">S'enregistrer</a></li>
<li><a href="/login/">Se connecter</a></li>
<?php } else { ?>
<li><a href="/logout/">Se déconnecter</a></li>
<?php } ?>

<?php if (user_is_connected()) { ?>
    <p>Vous êtes connecté <?php echo ucfirst(user_get_firstname()) . ' ' . ucfirst(user_get_lastname()) ?></p>
<?php } ?>
</body>
</html>