<?php

session_start();

require_once('../src/function.php');


// LOGOUT = need to unset variable session
if ($_SESSION && isset($_SESSION['email'])) {
    $_SESSION['email'] = NULL;
}

// THEN redirect to home page
header('Location: /');
