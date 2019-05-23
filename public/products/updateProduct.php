<?php

require_once __DIR__ . '/../../config/config.php';

// echo '<pre>';
// var_dump($_POST);
// var_dump($_FILES);
// echo '</pre>';

$id = $_GET['id'] ?? '';

if($id){
   $product = showProduct($id);
}

$name = $_POST['name'] ?? '';
$description = $_POST['description'] ?? '';
$price = $_POST['price'] ?? false;
$file = $_FILES['image'] ?? [];

if($name && $description && $price !== false){
    $result = updateProduct($name, $description, $price, $file, $id);

    if($result){
        echo 'Товар изменен';
        $product['name'] = $name;
        $product['description'] = $description;
        $product['price'] = $price;
    }else{
        echo 'Ошибка при добавлении товара';
    }
}


echo render(TEMPLATES_DIR . 'index.tpl',[
    'title' => 'Редактировать продукт',
    'h1' => 'Редактировать продукт',
    'content' => render(TEMPLATES_DIR . 'createProduct.tpl', $product),
    'style' => '../css/style.css',
]);