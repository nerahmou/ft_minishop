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

//--------------------------------------------------------------
//
// VALIDATOR of article from post
//
//--------------------------------------------------------------

function article_is_valid_creation() {
    if (is_set_in($_POST, 'name', 'description', 'img', 'price', 'categories', 'stock')) {
        if (count($_POST['name']) < 5) return 'Longueur du nom invalide. (min 5 caractères)';
        if (count($_POST['description']) < 10) return 'Longueur de la description invalide. (min 10 caractères)';
        if (is_url($_POST['img'])) return 'L\'image n\'est pas valide.';
        if (floatval($_POST['price']) >= 0) return 'Prix invalide.';
        if (floatval($_POST['stock']) >= 0) return 'Stock invalide.';
        foreach ($_POST['categories'] as $cat) {
            if (!category_from_name($cat)) return "Catégorie invalide: $cat";
        }
        return true;
    }
}

/* Inject new articles to test cart.
 *
 * $ar = new_article("test1", "description", "https://www.woodbrass.com/images/woodbrass/EAGLETONE+SOLEA.JPG", 100, 100);
 * articles_insert($ar);
 */