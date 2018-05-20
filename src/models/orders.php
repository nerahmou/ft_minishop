<?php

date_default_timezone_set('UTC');

function new_order($shopper, $cart, $total)
{
    return array(
        'id' => uniqid(),
        'shopper' => $shopper,
        'cart' => $cart,
        'date' => date("j/m/Y",time()),
        'total' => $total,
        'is_validate' => false
    );
}

function valid_order($order)
{
    articles_update_stock($order);
    $ord_tmp = $order;
    $ord_tmp['is_validate'] = true;
    orders_remove($ord_tmp['id']);
    order_insert($ord_tmp);
}

//--------------------------------------------------------------
//
// GETTER of orders
//
//--------------------------------------------------------------


function order_id($order)
{
    return $order['id'];
}

function order_shopper($order)
{
    return $order['shopper'];
}

function order_date($order)
{
    return $order['date'];
}