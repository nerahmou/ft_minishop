<?php need_install() ?>

<ul>
    <li><a href="/">Accueil</a></li>
    <?php if (!user_is_connected()) { ?>
    <li><a href="/register">S'enregistrer</a></li>
    <li><a href="/login">Se connecter</a></li>
<?php } else { ?>
    <li><a href="/logout">Se déconnecter</a></li>
<?php } ?>
    <li style="float: right;"><a href="/cart">Mon panier (<?php echo count_cart() ?>)</a></li>

<?php if (user_is_connected()) { ?>
    <li style="float: right"><a href=""><?php echo ucfirst(user_get_firstname()) . ' ' . ucfirst(user_get_lastname()) ?></a></li>
<?php } ?>
<?php if (user_is_admin()) {?>
    <li ><a href="/admin">Administration</a></li>
<?php } ?>
</ul>