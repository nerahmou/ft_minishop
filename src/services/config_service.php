<?php

/**
 * This file is here to communicate with the storage.
 * This file don't interact with the objects, refer to the appropriate model
 * to interact with them.
 *
 * Only read/write on storage and existence check are made.
 */

$config = [];
$prev = '/var/www/private/';
$conf_folder = $prev . "config.dat";

function conf_load()
{
    global $conf_folder;
    if (file_exists($conf_folder))
        return json_decode(file_get_contents($conf_folder), true);
    return [];
}

function conf_save()
{
    global $config, $conf_folder, $prev;
    if (!file_exists($prev)) mkdir($prev);
    file_put_contents($conf_folder, json_encode($config));
}

function config_set($conf) {
    global $config;
    $config = $conf;
    conf_save();
}

function conf_is_created() {
    global $config;
    return $config !== [];
}

function config() {
    global $config;
    return $config;
}

$config = conf_load();