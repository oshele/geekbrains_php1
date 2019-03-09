<?php

require_once __DIR__ . '/../../config/config.php';

//если пользователь не авторизован, перенаправляем его на логин
if(empty($_SESSION['login'])) {
	header('Location: /login.php');
}

$user_id = (int)$_SESSION['login']['id'];

//если корзина пуста выводим ошибку
if(empty($_COOKIE['cart'])) {
	echo 'Корзина пуста';
	exit();
}

//генерируем запрос и получаем id вставленной строки
$sql = "INSERT INTO `orders` (`user_id`) VALUES ('$user_id')";
$orderId = insert($sql);
//$orderId = 1;

//если строка не вставилась вызываем ошибку
if(!$orderId) {
	echo 'Произошла ошибка';
	exit();
}

//генерируем запрос в БД
$values = [];
foreach ($_COOKIE['cart'] as $productId => $amount) {
	$productId = (int)$productId;
	$amount = (int)$amount;
	$values[] = "($orderId, $productId, $amount)";
}

$values = implode(', ', $values);


$sql = "INSERT INTO `orders_products` (`order_id`, `product_id`, `amount`) VALUES $values";

//выполняем запрос
if(execQuery($sql)) {
	echo 'Заказ успешно создан';

	//очищаем куки корзины
	foreach ($_COOKIE['cart'] as $productId => $amount) {
		setcookie("cart[$productId]", null, -1, '/');
	}
} else {
	echo 'Произошла ошибка';
}


