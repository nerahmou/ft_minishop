<?php

//--------------------------------------------------------------
//
// CREATOR of config from post
//
//--------------------------------------------------------------

function config_creator_post() {
    $user = user_from_post(1);
    users_insert($user);
    config_set([
        'name' => $_POST['name_website'],
        'currency' => $_POST['currency_website']
    ]);
    return $user;
}

//--------------------------------------------------------------
//
// VALIDATOR of config from post
//
//--------------------------------------------------------------

function config_is_valid_creation() {
    $user_valid = user_is_valid_register();
    if (is_string($user_valid)) return $user_valid;
    if (!is_set_in($_POST, 'name_website', 'currency_website')) return 'Un ou plusieurs champs ne sont pas remplis.';
    return true;
}