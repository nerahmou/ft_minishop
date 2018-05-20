<?php

/**
 * This file is here to communicate with the storage.
 * This file don't interact with the objects, refer to the appropriate model
 * to interact with them.
 *
 * Only read/write on storage and existence check are made.
 */

$articles = [];
$prev = '/var/www/private/';
$articles_folder = $prev . "articles.dat";

function articles_load()
{
    global $articles_folder;
    if (file_exists($articles_folder))
        return json_decode(file_get_contents($articles_folder), true);
    return [];
}

function articles_save()
{
    global $articles, $articles_folder, $prev;
    if (!file_exists($prev)) mkdir($prev);
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

function articles_update_stock($order)
{
    $cart = $order['cart'];
    $articles = articles();
    foreach ($cart as $art_cart)
        foreach ($articles as $art)
            if ($art_cart['id'] === $art['id'])
            {
                $art_tmp = articles_from_id($art['id']);
                $art_tmp['stock'] -= $art_cart['quantity'];
                articles_remove($art_tmp['id']);
                articles_insert($art_tmp);
            }

}

function articles_remove($id) {
    global $articles;
    unset($articles[$id]);
    $articles = array_filter($articles);
    articles_save();
}

function articles_from_category($category)
{
    global $articles;
    if ($category === 'all') return $articles;
    $ret = [];
    foreach ($articles as $val)
        if (in_array($category, $val['categories'])) array_push($ret, $val);
    return $ret;
}

function articles() {
    global $articles;
    return $articles;
}

$articles = articles_load();