<?php

//--------------------------------------------------------------
//
// CREATOR of article from post/variables
//
//--------------------------------------------------------------

function new_article($name, $description, $img, $price, $stock, $categories = ['other'], $color = NULL) {
    return array(
        'name' => $name,
        'description' => $description,
        'img' => $img,
        'id' => uniqid(),
        'price' => $price,
        'stock' => $stock,
        'categories' => $categories,
        'colors' => $color
    );
}

//--------------------------------------------------------------
//
// GETTER of article
//
//--------------------------------------------------------------

function article_name($a) {
    return $a['name'];
}

function article_description($a) {
    return $a['description'];
}

function article_img($a) {
    return $a['img'];
}

function article_id($a) {
    return $a['id'];
}

function article_price($a) {
    return $a['price'];
}

function article_categories($a) {
    return $a['categories'];
}

function article_stock($a) {
    return $a['stock'];
}

function article_colors($a) {
    return $a['colors'];
}

/* Inject new articles to test cart.
 *
 * $ar = new_article("test1", "description", "https://www.woodbrass.com/images/woodbrass/EAGLETONE+SOLEA.JPG", 100, 100);
 * articles_insert($ar);
 */