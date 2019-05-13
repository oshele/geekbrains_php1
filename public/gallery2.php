<?php

require_once __DIR__ . '/../config/config.php';

echo render(TEMPLATES_DIR . 'index.tpl', [
	'title' => 'Галерея',
	'h1' => 'Эта галерея построена динамически',
	'content' => renderGallery(WWW_DIR . IMG_DIR, TEMPLATES_DIR . 'gallery2.tpl')
]);

