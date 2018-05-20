<?php

require_once '../../src/function.php';

need_install();

if (!user_is_admin()) header('Location: /');

if ($_GET && isset($_GET['email'])) {
    $user = users_from_email($_GET['email']);
    if ($user) {
        users_remove($_GET['email']);
    }
}

header('Location: /admin/');