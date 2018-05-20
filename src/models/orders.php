<?php

function new_order($shopper, $cart, $total)
{
    return array(
        'id' => uniqid(),
        'shopper' => $shopper,
        'cart' => $cart,
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