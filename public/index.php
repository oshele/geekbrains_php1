<?php

require_once __DIR__ . '/../config/config.php';

$img = [
	'img/file1.jpg',
	'img/file2.jpg'
];


var_dump(scandir('./'));

//echo render(TEMPLATES_DIR . 'index.tpl', [
//	'title' => 'Заголовок супер длинный',
//	'h1' => 'Привет, жестокий мир!',
//	'content' => 'Какая-то инфа'
//]);
