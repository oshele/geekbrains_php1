<?php

require_once '../config/config.php';


echo render(TEMPLATES_DIR . 'index.tpl', [
	'title' => 'Новости',
	'h1' => 'Горячие новости',
	'content' => ''
]);
