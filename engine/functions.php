<?php


function render($file, $variables = [])
{
	if (!is_file($file)) {
		echo 'Template file "' . $file . '" not found';
		exit();
	}

	if (filesize($file) === 0) {
		echo 'Template file "' . $file . '" is empty';
		exit();
	}


	$templateContent = file_get_contents($file);

	foreach ($variables as $key => $value) {
		if (!is_string($value)) {
			continue;
		}

		$key = '{{' . strtoupper($key) . '}}';

		$templateContent = str_replace($key, $value, $templateContent);
	}

	return $templateContent;
}


function renderGalleryItem($fileName,$file){
	$galleryItem = file_get_contents($file);
	$src = "/img/" . $fileName;

	$galleryItem = str_replace('{{SRC}}', "$src", $galleryItem);
	return $galleryItem;
}


function renderGallery($directory, $file){
	
	$files = scandir($directory);
	$content = "";

	foreach ($files as $key => $fileName){
		if($key < 2){
			continue;
		}
		$content = $content . renderGalleryItem($fileName, $file);
		
	}
	return $content;
}
