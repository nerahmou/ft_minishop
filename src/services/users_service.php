<?php

/**
 * This file is here to communicate with the storage.
 * This file don't interact with the objects, refer to the appropriate model
 * to interact with them.
 *
 * Only read/write on storage and existence check are made.
 */

$users = [];
$prev = '/var/www/private/';
$users_folder = $prev . "users.dat";

function users_load()
{
    global $users_folder;
    if (file_exists($users_folder))
        return json_decode(file_get_contents($users_folder), true);
    return [];
}

function users_save()
{
    global $users, $users_folder, $prev;
    if (!file_exists($prev)) mkdir($prev);
    file_put_contents($users_folder, json_encode($users));
}

function users_insert($user)
{
    global $users;
    $users[$user['email']] = $user;
    users_save();
}

function users_exist($email)
{
    global $users;
    return array_key_exists($email, $users);
}

function users_from_email($email)
{
    global $users;
    if (isset($users[$email])) return $users[$email];
    return NULL;
}

function users_remove($email)
{
    global $users;
    if (users_exist($email)) {
        unset($users[$email]);
    }
    users_save();
}

function users_can_login($email, $password)
{
    $user = users_from_email($email);
    if ($user)
        return $user['password'] === hash('sha512', $password);
    return false;
}

function users()
{
    global $users;
    return $users;
}

$users = users_load();

//var_dump($users);