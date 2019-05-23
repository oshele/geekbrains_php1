<?php

require_once __DIR__ . '/../../config/config.php';

// echo '<pre>';
// var_dump($_POST);
// var_dump($_FILES);
// echo '</pre>';

$name = $_POST['name'] ?? '';
$description = $_POST['description'] ?? '';
$price = $_POST['price'] ?? false;
$file = $_FILES['image'] ?? '';

if($name && $description && $price !== false){
    $result = createProduct($name, $description, $price, $file);

    if($result){
        echo 'Товар добален';
        $name = '';
		$description = '';
		$price = 0;
    }else{
        echo 'Ошибка при добавлении товара';
    }
}else {
    echo 'Недостаточно данных';
}

echo render(TEMPLATES_DIR . 'index.tpl',[
    'title' => 'Создать продукт',
    'h1' => 'Создать продукт',
    'content' => render(TEMPLATES_DIR . 'createProduct.tpl', [
        'name' => $name,
        'description' => $description,
        'price' => $price,
    ]),
    'style' => '../css/style.css',
]);