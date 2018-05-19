<?php

session_start();

require_once 'src/services/users_service.php';
require_once 'src/function.php';

if (isset($_POST, $_POST['id']))
    insert_article(articles_from_id($_POST['id']), 1);

?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
</head>
<p>
<?php if (!user_is_connected()) { ?>
<li><a href="/register/">S'enregistrer</a></li>
<li><a href="/login/">Se connecter</a></li>
<?php } else { ?>
<li><a href="/logout/">Se déconnecter</a></li>
<?php } ?>

<a href="/cart/">

    <img style="width: 100px; float: right" src="https://cdn.pixabay.com/photo/2013/07/12/17/01/shopping-cart-151685_1280.png" alt="cart"></a>
<p style="display: inline-block;float: right; color: red; font-size: 2em"><?php
    if(!empty($_SESSION['cart']))
        echo count($_SESSION['cart']);
    ?></p>
<?php if (user_is_connected()) { ?>
    <p>Vous êtes connecté <?php echo ucfirst(user_get_firstname()) . ' ' . ucfirst(user_get_lastname()) ?></p>
    <li><a href="/admin/add/article.php">Ajouter un article</a></li>


<?php } ?>

<h3>Liste des articles : </h3>

<?php
foreach (articles() as $key => $elem) { ?>
    <div style="border: solid 1px black; display: inline-block" >
        <p /> Nom : <?php echo $elem['name'] ?></p>
        <p /> Description : <?php echo $elem['description'] ?></p>
        <p /> Prix : <?php echo $elem['price'] ?></p>
        <img style="width: 200px; " src="<?php echo $elem['img'] ?>"/>
        <p /> Catégories : <?php echo implode(', ', article_categories($elem));?></p>
        <form method="post">
            <button name="id" value="<?php echo article_id($elem)?>" type="submit">Ajouter au panier</button>
        </form>
    </div>
<?php } ?>
</body>
</html>