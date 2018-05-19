<?php

require_once '../../src/function.php';

//if (!user_is_admin()) header('Location: /');

if ($_GET && isset($_GET['name'])) {
    $cat = categories_from_name($_GET['name']);
    if ($cat) {
        categories_remove($_GET['name']);
    }
}

//header('Location: /admin/');