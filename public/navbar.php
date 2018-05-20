<ul>
<?php if (!user_is_connected()) { ?>
    <li><a href="/register">S'enregistrer</a></li>
    <li><a href="/login">Se connecter</a></li>
<?php } else { ?>
    <li><a href="/logout">Se déconnecter</a></li>
<?php } ?>

<?php if (user_is_admin()) {?>
    <li ><a href="/admin">Administration</a></li>
<?php } ?>
<li style="float: right;"><a href="/cart">Mon panier (<?php echo count_cart() ?>)</a></li>
</ul>