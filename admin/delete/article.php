<?php

session_start();
require_once '../../src/function.php';
need_install();
if (!user_is_admin()) header('Location: /');

if ($_GET && isset($_GET['id'])) {
    $article = articles_from_id($_GET['id']);
    if ($article) {
        articles_remove($_GET['id']);
    }
}

header('Location: /admin/articles');