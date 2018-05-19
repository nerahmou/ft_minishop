<?php

/**
 * This file is here to communicate with the storage.
 * This file don't interact with the objects, refer to the apropriate model
 * to interact with them.
 *
 * Only read/write on storage and existence check are made.
 */

$articles = [];
$articles_folder = "/var/www/html/private/articles.dat";

function articles_load()
{
    global $articles_folder;
    if (file_exists($articles_folder))
        return json_decode(file_get_contents($articles_folder), true);
    return [];
}

function articles_save()
{
    global $articles, $articles_folder;
    if (!file_exists($articles_folder)) mkdir("/var/www/html/private/");
    file_put_contents($articles_folder, json_encode($articles));
}

function articles_insert($article)
{
    global $articles;
    $articles[$article['id']] = $article;
    articles_save();
}

function articles_from_id($id)
{
    global $articles;
    foreach ($articles as $art_id => $val)
        if ($art_id === $id) return $val;
    return NULL;
}

function articles_from_category($category)
{
    global $articles;
    $ret = [];
    foreach ($articles as $val)
        if (in_array($val['categories'], $category)) array_push($ret, $val);
    return $ret;
}

$articles = articles_load();