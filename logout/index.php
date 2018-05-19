<?php

session_start();

require_once('../src/function.php');

//
// IF CONNECTED REDIRECT TO HOME PAGE
//
if ($_SESSION && isset($_SESSION['email'])) {
    $_SESSION['email'] = NULL;
}

header('Location: /');
