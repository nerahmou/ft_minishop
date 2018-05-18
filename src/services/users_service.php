<?php

$users = [];
$users_folder = "/var/www/private/users.dat";

function users_load()
{
    global $users_folder;
    if (file_exists($users_folder))
        return json_decode(file_get_contents($users_folder));
    return [];
}

function users_save()
{
    global $users, $users_folder;
    if (!file_exists($users_folder)) mkdir("/var/www/private/");
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

$users = users_load();