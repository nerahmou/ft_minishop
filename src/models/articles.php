<?php

//--------------------------------------------------------------
//
// CREATOR of article from post/variables
//
//--------------------------------------------------------------

function new_article($name, $description, $img, $price, $stock, $categories = ['other'], $color = NULL)
{
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

function article_from_post()
{
    return new_article(
        $_POST['name'],
        $_POST['description'],
        $_POST['img'],
        floatval($_POST['price']),
        floatval($_POST['stock']),
        $_POST['categories']
    );
}

//--------------------------------------------------------------
//
// GETTER of article
//
//--------------------------------------------------------------

function article_name($article)
{
    return $article['name'];
}

function article_description($article)
{
    return $article['description'];
}

function article_img($article)
{
    return $article['img'];
}

function article_id($article)
{
    return $article['id'];
}

function article_price($article)
{
    return $article['price'];
}

function article_categories($article)
{
    return $article['categories'];
}

function article_stock($article)
{
    return $article['stock'];
}

function article_colors($article)
{
    return $article['colors'];
}

function article_has_category($category, $article)
{
    return in_array($category, article_categories($article));
}

//--------------------------------------------------------------
//
// VALIDATOR of article from post
//
//--------------------------------------------------------------

function article_is_valid_creation()
{
    if (is_set_in($_POST, 'name', 'description', 'img', 'price', 'categories', 'stock')) {
        if (strlen($_POST['name']) < 5) return 'Longueur du nom invalide. (min 5 caractères)';
        if (strlen($_POST['description']) < 10) return 'Longueur de la description invalide. (min 10 caractères)';
        if (!is_url($_POST['img'])) return 'L\'image n\'est pas valide.';
        if (floatval($_POST['price']) < 0) return 'Prix invalide.';
        if (floatval($_POST['stock']) < 0) return 'Stock invalide.';
        foreach ($_POST['categories'] as $cat) {
            if (!categories_from_name($cat)) return "Catégorie invalide: $cat";
        }
        return true;
    }
}

/* Inject new articles to test cart.
 *
 * $ar = new_article("test1", "description", "https://www.woodbrass.com/images/woodbrass/EAGLETONE+SOLEA.JPG", 100, 100);
 * articles_insert($ar);
 */