<?php

function create_cart(){
    if (!isset($_SESSION['cart'])){
        $_SESSION['cart']=array();
        $_SESSION['cart']['name'] = array();
        $_SESSION['cart']['description'] = array();
        $_SESSION['cart']['img'] = array();
        $_SESSION['cart']['price'] = array();
        $_SESSION['cart']['quantity'] = array();
        $_SESSION['cart']['stock'] = array();
        $_SESSION['cart']['categories'] = array();
        $_SESSION['cart']['color'] = array();
    }
    return true;
}

function is_in_cart($article_name)
{
    $position = array_search($article_name,  $_SESSION['cart']['name']);
    if ($position !== false)
        return $position;
    return false;
}

function articles_insert($article)
{
    create_cart();
    if (($position = is_in_cart($article['name'])))
        $_SESSION['cart']['quantity'][$position] += $article['quantity'];
    else
    {
        array_push($_SESSION['cart']['name'], $article['name']);
        array_push($_SESSION['cart']['description'], $article['description']);
        array_push($_SESSION['cart']['img'], $article['img']);
        array_push($_SESSION['cart']['price'], $article['price']);
        array_push($_SESSION['cart']['quantity'], $article['quantity']);
        array_push($_SESSION['cart']['stock'], $article['stock']);
        array_push($_SESSION['cart']['categories'], $article['categories']);
        array_push($_SESSION['cart']['color'], $article['color']);
    }

}