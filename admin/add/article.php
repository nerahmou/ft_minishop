<?php

session_start();

require_once '../../src/function.php';

if (!user_is_admin()) header('Location: /');

if ($_POST) {
    $msg = '';
    if (!is_string($msg = article_is_valid_creation()) && $msg) {
        $article = article_from_post();
        articles_insert($article);
        set_success_message('Vous avez créé l\'article ' . article_name($article) . '.');
    } else set_error_message($msg);
}

?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ajouter un article</title>
</head>
<body>

<h1>Ajouter un article</h1>

<?php html_message() ?>

<br>
<form method="post">
    <input type="text" name="name" placeholder="Nom de l'article">
    <br>
    <textarea name="description" placeholder="Description"> </textarea>
    <br>
    <input type="url" name="img" placeholder="Image de l'article">
    <br>
    <input type="number" name="price" placeholder="Prix">
    <br>
    <input type="number" name="stock" placeholder="Stock">
    <br>
    <?php
        foreach (get_categories() as $k) { ?>
            <input type="checkbox" name="categories[]" value="<?php echo $k ?>" /><?php echo ucfirst($k) ?><br />
        <?php
        }
    ?>
    <input type="submit">
</form>

</body>
</html>

