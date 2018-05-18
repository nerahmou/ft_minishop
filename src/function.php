<?php

function is_set_in() {
    foreach(array_slice(func_get_args(), 1) as $v) {
        if (!isset(func_get_arg(0)[$v])) return false;
    }
    return true;
}

function is_email($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}


function set_error_message($msg) {
    $_SESSION['msg_err'] = $msg;
}

function has_error_message() {
    return isset($_SESSION['msg_err']) && strlen($_SESSION['msg_err']) > 0;
}

function get_error_message() {
    if (has_error_message())
    {
        $msg = $_SESSION['msg_err'];
        $_SESSION['msg_err'] = NULL;
        return $msg;
    }
    return "";
}

function set_success_message($msg) {
    $_SESSION['msg_success'] = $msg;
}

function has_success_message() {
    return isset($_SESSION['msg_success']) && strlen($_SESSION['msg_success']) > 0;
}

function get_success_message() {
    if (has_error_message())
    {
        $msg = $_SESSION['msg_success'];
        $_SESSION['msg_success'] = NULL;
        return $msg;
    }
    return "";
}

function html_message() {
    if (has_error_message()) {?> <h2>Error: <?php get_error_message() ?></h2> <?php }
    if (has_success_message()) {?> <h2>Success: <?php get_success_message() ?></h2> <?php }
}


/*
 * STARTING MERGE OF MODELS
 */

function new_user($firstname, $lastname, $email, $password, $rank = 0) {
    return $user = array(
        'firstname' => $firstname,
        'lastname' => $lastname,
        'email' => $email,
        'password' => hash('sha512', $password),
        'rank' => $rank,
    );
}

function user_from_post() {
    return new_user(
        $_POST['firstname'],
        $_POST['lastname'],
        $_POST['email'],
        $_POST['password']
    );
}

function user_is_valid() {
    if (is_set_in($_POST, 'firstname', 'lastname', 'email', 'password', 'confirm_password')) {
        if (!is_email($_POST['email'])) return 'Email invalide.';
        if (!preg_match('/^[A-Zaz]{3,}$/', $_POST['firstname'])) return 'Prénom invalide. (min 3 caractères alphabétiques)';
        if (!preg_match('/^[A-Zaz]{3,}$/', $_POST['lastname'])) return 'Nom invalide. (min 3 caractères alphabétiques)';
        if (strlen($_POST['password']) < 4) return 'Mot de passe invalide (min 4 caractères).';
        if (strlen($_POST['password']) !== $_POST['password_confirm']) return 'La confirmation du mot de passe a échoué.';
        return true;
    }
    return 'Un ou plusieurs champs ne sont pas remplis.';
}