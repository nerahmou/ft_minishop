<?php

session_start();

require_once '../../src/function.php';

need_install();

if (!user_is_admin()) header('Location: /');

if ($_POST && isset($_POST['name'])) {
    if (!empty($_POST['name']) && !categories_from_name(strtolower($_POST['name']))) {
        categories_add(strtolower($_POST['name']));
        set_success_message("Catégorie " . $_POST['name'] . " créé.");
    }
    else set_error_message("La catégorie existe déjà ou le formulaire est vide.");
}

?>

<?php
include '../../public/navbar_admin_p.php';

html_header('Ajouter une catégorie') ?>

<?php html_message() ?>

<br>
<form method="post">
    <label for="name">Nom de catégorie</label> <br>
    <input type="text" name="name">
    <br>
    <br>
    <input type="submit" value="Valider">
</form>

<?php html_footer() ?>

