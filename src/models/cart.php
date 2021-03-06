<?php

function create_cart(){
    if (!isset($_SESSION['cart']))
        $_SESSION['cart'] = array();
    return true;
}

function get_total()
{
    $total = 0;
    foreach ($_SESSION['cart'] as $line)
        $total += articles_from_id($line['id'])['price'] * $line['quantity'];
    return ($total);
}

function is_in_cart($article)
{
    for ($i = 0; $i < count($_SESSION['cart']); $i++)
        if ($_SESSION['cart'][$i]['id'] === article_id($article))
            return $i;
    return false;
}

function insert_article($article, $quantity)
{
    create_cart();
    if ($quantity > $article['stock'])
        return false;
    if (($position = is_in_cart($article)) !== false)
    {
        if ($_SESSION['cart'][$position]['quantity'] + $quantity <= $article['stock'])
            $_SESSION['cart'][$position]['quantity'] += $quantity;
        else
            return false;
    }
    else
        array_push($_SESSION['cart'], array(
                'id' => article_id($article),
                'quantity' => $quantity,
                'color' => $article['colors'],
                'price' => article_price($article))
        );
    return true;
}

function drop_article($article_id)
{
    if (!isset($_SESSION['cart']))
        return ;
    $tmp = array();
    foreach ($_SESSION['cart'] as $article)
        if ($article['id'] != $article_id)
        {
            array_push( $tmp, $article);

        }
    $_SESSION['cart'] = $tmp;
    unset($tmp);
}

function count_cart() {
    return isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
}