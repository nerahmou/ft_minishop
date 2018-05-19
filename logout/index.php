<?php

session_start();

require_once('../src/function.php');


// LOGOUT = need to unset variable session
if (user_is_connected()) {
    $_SESSION['email'] = null;
}

// THEN redirect to home page
header('Location: /');
