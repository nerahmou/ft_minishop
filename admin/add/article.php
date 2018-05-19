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

<?php html_header('Ajouter un article') ?>

<?php html_message() ?>

<br>
<form method="post">
    <label for="name">Nom</label> <br>
    <input type="text" name="name" placeholder="Nom de l'article">
    <br>
    <label for="description">Description</label> <br>
    <textarea name="description" placeholder="Description"> </textarea>
    <br>
    <label for="img">Image</label> <br>
    <input type="url" name="img" placeholder="Image de l'article">
    <br>
    <label for="price">Prix</label> <br>
    <input type="number" name="price" placeholder="Prix">
    <br>
    <label for="price">Stock</label> <br>
    <input type="number" name="stock" placeholder="Stock">
    <br>
    <label for="categories">Catégories</label> <br>
    <?php
        foreach (categories() as $k) { ?>
            <input type="checkbox" name="categories[]" value="<?php echo $k ?>" /><?php echo ucfirst($k) ?><br />
        <?php
        } ?>
    <input type="submit">
</form>

<?php html_footer() ?>

