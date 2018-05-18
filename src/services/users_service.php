<?php

$users = load_users();
$users_folder = "../data/users.data";

function users_load() {
    global $users_folder;
    if (file_exists($users_folder))
        return json_decode(file_get_contents($users_folder));
    return [];
}

function users_save() {
    global $users, $users_folder;
    if (!file_exists($users_folder)) mkdir("../data/");
    file_put_contents($users_folder, json_encode($users));
}

function users_insert($user) {
    global $users;
    $users[$user['email']] =  $user;
    save_users();
}

function users_from_email($email) {
    global $users;
    foreach ($users as $user_mail => $val)
        if ($user_mail === $email) return $val;
    return NULL;
}
