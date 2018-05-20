<?php

date_default_timezone_set('UTC');

function new_order($shopper, $cart, $total)
{
    return array(
        'id' => uniqid(),
        'shopper' => $shopper,
        'cart' => $cart,
        'date' => date("j/m/Y",time()),
        'total' => $total
    );
}

function valid_order($order)
{

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