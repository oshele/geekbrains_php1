<?php

require_once __DIR__ . '/../config/config.php';


// var_dump(scandir(WWW_DIR . IMG_DIR));


echo render(TEMPLATES_DIR . 'index.tpl', [
	'title' => 'Галерея',
	'h1' => 'Это галерея выполненная по статичным путям файлов',
	'content' => render(TEMPLATES_DIR . 'gallery1.tpl')
]);
