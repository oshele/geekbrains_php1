<?php

require_once __DIR__ . '/../../config/config.php';

$catalogContent = renderProducts();

echo render(TEMPLATES_DIR . 'index.tpl', [
	'title' => 'Каталог',
	'h1' => 'Каталог',
	'content' => $catalogContent,
	'style' => '../css/style.css'
]);