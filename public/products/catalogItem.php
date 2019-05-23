<?php

require_once __DIR__ . '/../../config/config.php';

$id = isset($_GET['id']) ? $_GET['id'] : '';

if(!$id){
    echo 'id не передан';
	exit(); 
}

$product = showProduct($id);

echo render(TEMPLATES_DIR . 'index.tpl',[
    'title' => 'Каталог',
    'h1' => $product['name'],
    'content' => render(TEMPLATES_DIR . 'catalogItem.tpl', $product),
    'style' => '../css/style.css',
]);