<?php

require_once __DIR__ . '/../../config/config.php';



echo render(TEMPLATES_DIR . 'index.tpl', [
    'title' => 'Оформить заказ',
	'h1' => 'Корзина',
	'content' => renderProductsCart($_COOKIE['cart'] ?? []),
	'button' => empty($_SESSION['login'])
		? '<a href="/login.php" class = "buy right">Войти</a>'
        : '<a href="/products/createOrder.php" class="buy right">Оформить заказ</a>',
    'style' => '../css/style.css'
]);