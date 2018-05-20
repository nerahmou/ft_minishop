<?php

session_start();

require_once 'src/services/users_service.php';
require_once 'src/function.php';

need_install();

if (isset($_POST, $_POST['id']))
    if (!insert_article(articles_from_id($_POST['id']), $_POST['quantity']))
        set_error_message("Quantité superieur au stock disponible : (".articles_from_id($_POST['id'])['stock'].")");

html_header(config()['name']);

?>


<?php if (!user_is_connected()) { ?>
<li><a href="/register/">S'enregistrer</a></li>
<li><a href="/login/">Se connecter</a></li>
<?php } else { ?>
<li><a href="/logout/">Se déconnecter</a></li>
<?php } ?>

<?php if (user_is_admin()) {?>
    <li><a href="/admin/">Administration</a></li>
<?php } ?>
<br>
<li><a href="/cart/">Mon panier (<?php echo count_cart() ?>)</a></li>


<?php if (user_is_connected()) { ?>
    <p>Vous êtes connecté <?php echo ucfirst(user_get_firstname()) . ' ' . ucfirst(user_get_lastname()) ?></p>
<?php } ?>

<h3>Liste des articles : </h3>

<?php
html_message();

?>

<section id="page">
    <?php foreach (articles() as $key => $elem) { ?>
    <div class="item">
        <div class="item-container">
            <div class="image-container" style="background-image: url(<?php echo $elem['img'] ?>)"></div>
            <div class="text-container">
                <h2><?php echo $elem['name']; ?></h2>
                <h5>Catégorie(s) : <?php echo implode(', ', article_categories($elem));?></h5>
                <p><?php echo article_description_trunc($elem) ?></p>
                <form method="post">
                    <button name="id" value="<?php echo article_id($elem)?>" type="submit">Ajouter au panier</button>
                    <input type="number" min="1" name="quantity" value="1">
                    <div class="icon"><img src="https://partage.draftman.fr/icon.svg" alt=""></div>
                </form>
            </div>
        </div>
    </div>
    <?php } ?>
</section>
<?php html_footer() ?>
