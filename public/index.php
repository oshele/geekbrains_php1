<?php

require_once __DIR__ . '/../config/config.php';

echo render(TEMPLATES_DIR . 'index.tpl', [
	'title' => 'Заголовок супер длинный',
	'h1' => 'Привет, жестокий мир!',
	'content' => createGallery()
]);
