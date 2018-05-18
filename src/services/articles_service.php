<?php


$articles = [];
$articles_folder = "../data/users.data";

function articles_load() {
    global $articles_folder;
    if (file_exists($articles_folder))
        return json_decode(file_get_contents($articles_folder));
    return [];
}

function articles_save() {
    global $articles, $articles_folder;
    if (!file_exists($articles_folder)) mkdir("../data/");
    file_put_contents($articles_folder, json_encode($articles));
}

function articles_insert($article) {
    global $articles;
    $articles[$article['id']] =  $article;
    articles_save();
}

function articles_from_id($id) {
    global $articles;
    foreach ($articles as $art_id => $val)
        if ($art_id === $id) return $val;
    return NULL;
}

function articles_from_category($category) {
    global $articles;
    foreach ($articles as $val)
        if (in_array($val['categories'], $category)) return $val;
    return NULL;
}

$users = articles_load();