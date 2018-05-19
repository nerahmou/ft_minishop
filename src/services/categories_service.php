<?php

/**
 * This file is here to communicate with the storage.
 * This file don't interact with the objects, refer to the appropriate model
 * to interact with them.
 *
 * Only read/write on storage and existence check are made.
 */

$categories = ['other'];
$prev = '/var/www/private/';
$categories_folder = $prev . "categories.dat";

function categories_load()
{
    global $categories_folder;
    if (file_exists($categories_folder))
        return json_decode(file_get_contents($categories_folder), true);
    return ['other'];
}

function categories_save()
{
    global $categories, $categories_folder, $prev;
    if (!file_exists($categories_folder)) mkdir($prev);
    file_put_contents($categories_folder, json_encode($categories));
}

function category_from_name($name) {
    global $categories;
    if (in_array($categories, $name)) {
        return $name;
    }
    return NULL;
}

function get_categories() {
    global $categories;
    return $categories;
}

function remove_categoy($name) {
    $cat = category_from_name($name);
    if ($cat) {
        $articles = articles_from_category($cat);
        foreach ($articles as $id => $article) {
            $new_cat = array_delete($cat, $article['categories']);
            if (count($new_cat) === 0)
                array_push($new_cat, 'other');
            $article['categories'] = $new_cat;
            articles_insert($article);
        }
    }
    return NULL;
}

$categories = categories_load();