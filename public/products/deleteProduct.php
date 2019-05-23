<?php

require_once __DIR__ . '/../../config/config.php';

$id = $_GET['id'] ?? '';

if($id){
    $product = showProduct($id);
 }

$name = $_POST['name'] ?? '';
$description = $_POST['description'] ?? '';
$price = $_POST['price'] ?? false;

if($name && $description && $price !== false) {
    $result = deleteProduct($id, $product['image']);
    if($result){
        header('Location: /products/index.php');
    }else{
        echo 'Не удалось удалить товар';
    }
}

 echo render(TEMPLATES_DIR . 'index.tpl',[
    'title' => 'Удалить продукт',
    'h1' => 'Вы хотите удалить товар?',
    'content' => render(TEMPLATES_DIR . 'createProduct.tpl', $product),
    'style' => '../css/style.css',
]);