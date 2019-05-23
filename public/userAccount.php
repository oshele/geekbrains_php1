<?php


require_once __DIR__ . '/../config/config.php';


echo render(TEMPLATES_DIR . 'index.tpl', [
	'title' => 'Личный кабинет',
	'h1' => "Добро пожаловать, " . $_SESSION['login']['name'],
    'content' => '<a href = "/logout.php" class = "buy">Выход</a>',
    'style' => 'css/style.css',
]);