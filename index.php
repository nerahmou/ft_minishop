<?php

session_start();

require_once 'src/services/users_service.php';
require_once 'src/function.php';

need_install();

if (isset($_POST, $_POST['id']))
    insert_article(articles_from_id($_POST['id']), $_POST['quantity']);

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
foreach (articles() as $key => $elem) { ?>
    <div style="border: solid 1px black; display: inline-block" >
        <p /> Nom : <?php echo $elem['name'] ?></p>
        <p /> Description : <?php echo $elem['description'] ?></p>
        <p /> Prix : <?php echo $elem['price'] . " " . config()['currency'] ?></p>
        <img style="width: 200px; " src="<?php echo $elem['img'] ?>"/>
        <p /> Catégories : <?php echo implode(', ', article_categories($elem));?></p>

        <form method="post">
            <button name="id" value="<?php echo article_id($elem)?>" type="submit">Ajouter au panier</button>
            <input style="width: 15%" type="number" min="1" name="quantity" value="1">
        </form>

    </div>
<?php }
html_footer()
?>
