<?php

require_once __DIR__ . '/../config/config.php';



echo render(TEMPLATES_DIR . 'index.tpl', [
	'title' => 'Новости',
	'h1' => 'Горячие новости',
	'content' => render(TEMPLATES_DIR . 'login.tpl', []),
]);