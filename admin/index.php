<?php

session_start();

require_once '../src/function.php';

if (!user_is_admin()) header('Location: /');

?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Administration</title>
</head>
<body>

<li><a href="/admin/add/article.php">Ajouter un article</a></li>
<li><a href="/admin/delete/article.php">Supprimer un article</a></li>

<li><a href="/admin/add/category.php">Ajouter une catégorie</a></li>
<li><a href="/admin/delete/category.php">Supprimer une catégorie</a></li>

<li><a href="/admin/orders/"></a>Les commandes (N)</li>

</body>
</html>
