<?php

$orders = [];
$prev = '/var/www/private/';
$orders_folder = $prev . "orders.dat";

function orders_load()
{
    global $orders_folder;
    if (file_exists($orders_folder))
        return json_decode(file_get_contents($orders_folder), true);
    return [];
}

function orders_save()
{
    global $orders, $orders_folder, $prev;
        if (!file_exists($prev)) mkdir($prev);
    file_put_contents($orders_folder, json_encode($orders));
}

function order_insert($order)
{
    global $orders;
    $orders[$order['id']] = $order;
    orders_save();
    unset($_SESSION['cart']);
}

function orders_remove($id) {
    global $orders;
    unset($orders[$id]);
    $orders = array_filter($orders);
    orders_save();
}

function orders_from_id($id)
{
    global $orders;
    foreach ($orders as $ord_id => $val)
        if ($ord_id === $id) return $val;
    return NULL;
}

function orders() {
    global $orders;
    return $orders;
}

$orders = orders_load();
