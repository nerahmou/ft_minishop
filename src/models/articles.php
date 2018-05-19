<?php

//--------------------------------------------------------------
//
// CREATOR of article from post/variables
//
//--------------------------------------------------------------

function new_article($name, $description, $img, $price, $stock, $categories, $color = NULL) {
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

