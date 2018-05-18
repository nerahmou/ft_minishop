<?php

require '../util.php';

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
