<?php

session_start();

require_once '../../src/function.php';

need_install();

if (!user_is_admin()) header('Location: /');

if ($_GET && isset($_GET['id']))
    if (!articles_from_id($_GET['id'])) header('Location: /admin/');

if ($_POST && $_GET && isset($_GET['id'])) {
    $article_o = articles_from_id($_GET['id']);
    $msg = '';
    if (!is_string($msg = article_is_valid_creation()) && $msg) {
        $article = article_from_post();
        $article['id'] = $article_o['id'];
        articles_insert($article);
        set_success_message('Vous avez édité l\'article ' . article_name($article) . '.');
    } else set_error_message($msg);
}

?>

<?php
include '../../public/navbar_admin_p.php';
html_header("Edition article " . article_id(articles_from_id($_GET['id']))); ?>

<?php html_message(); ?>

    <form method="post">
        <label for="name">Nom</label> <br>
        <input type="text" name="name" value="<?php echo article_name(articles_from_id($_GET['id'])) ?>">
        <br>
        <label for="description">Description</label> <br>
        <textarea name="description"><?php echo article_description(articles_from_id($_GET['id'])) ?></textarea>
        <br>
        <label for="img">Image</label> <br>
        <input type="url" name="img" value="<?php echo article_img(articles_from_id($_GET['id'])) ?>">
        <br>
        <label for="price">Prix</label> <br>
        <input type="number" name="price" min="0" value="<?php echo article_price(articles_from_id($_GET['id'])) ?>">
        <br>
        <label for="price">Stock</label> <br>
        <input type="number" name="stock" min="0" value="<?php echo article_stock(articles_from_id($_GET['id'])) ?>">
        <br>
        <label for="categories">Catégories</label> <br>
        <?php
        foreach (categories() as $k) { ?>
            <input type="checkbox" name="categories[]"
                   value="<?php echo $k ?>" <?php echo article_has_category($k, articles_from_id($_GET['id'])) ? 'checked' : '' ?>/><?php echo ucfirst($k) ?>
            <br/>
            <?php
        }
        ?>
        <input type="submit" value="Valider">
    </form>

<?php

html_footer();



