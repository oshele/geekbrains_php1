<?php

require_once __DIR__ . '/../config/config.php';

// $gallery = createGallery(IMG_DIR);
// $gallery = 'Галерея';
$images = getImages();
$gallery = renderGallery($images);

echo render(TEMPLATES_DIR . 'index.tpl', [
	'title' => 'Галерея',
	'h1' => 'Лучшие картиночки',
	'content' => $gallery,
	'style' => 'css/style.css',
]);



