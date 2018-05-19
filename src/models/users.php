<?php

//--------------------------------------------------------------
//
// CREATOR of user from post/variables
//
//--------------------------------------------------------------

function new_user($firstname, $lastname, $email, $password, $rank = 0)
{
    return $user = array(
        'firstname' => $firstname,
        'lastname' => $lastname,
        'email' => $email,
        'password' => hash('sha512', $password),
        'rank' => $rank,
    );
}

function user_from_post()
{
    return new_user(
        $_POST['firstname'],
        $_POST['lastname'],
        $_POST['email'],
        $_POST['password']
    );
}

//--------------------------------------------------------------
//
// GETTERS of user from session
//
//--------------------------------------------------------------

function user_get_email() {
    if ($_SESSION && isset($_SESSION['email'])) {
        return users_from_email($_POST['email'])['email'];
    }
    return NULL;
}

function user_get_lastname() {
    if ($_SESSION && isset($_SESSION['email'])) {
        return users_from_email($_SESSION['email'])['lastname'];
    }
    return NULL;
}

function user_get_firstname() {
    if ($_SESSION && isset($_SESSION['email'])) {
        return users_from_email($_SESSION['email'])['firstname'];
    }
    return NULL;
}

function user_is_connected() {
    return $_SESSION && isset($_SESSION['email']);
}

//--------------------------------------------------------------
//
// VALIDATOR of user from post
//
//--------------------------------------------------------------

function user_is_valid_register()
{
    if (is_set_in($_POST, 'firstname', 'lastname', 'email', 'password', 'confirm_password')) {
        if (!is_email($_POST['email'])) return 'Email invalide.';
        if (users_exist($_POST['email'])) return 'L\'email existe déjà.';
        if (!preg_match('/^[A-Za-z]{3,}$/', $_POST['firstname'])) return 'Prénom invalide. (min 3 caractères alphabétiques)';
        if (!preg_match('/^[A-Za-z]{3,}$/', $_POST['lastname'])) return 'Nom invalide. (min 3 caractères alphabétiques)';
        if (strlen($_POST['password']) < 4) return 'Mot de passe invalide (min 4 caractères).';
        if ($_POST['password'] !== $_POST['confirm_password']) return 'La confirmation du mot de passe a échoué.';
        return true;
    }
    return 'Un ou plusieurs champs ne sont pas remplis.';
}

function user_is_valid_login() {
    if (is_set_in($_POST, 'email', 'password')) {
        if (!users_exist($_POST['email']) || !users_can_login($_POST['email'], $_POST['password']))
            return 'Combinaison mot de passe/email incorrect.';
        return true;
    }
    return 'Un ou plusieurs champs ne sont pas remplis.';
}