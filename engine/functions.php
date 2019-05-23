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


function createGallery($imgDir) {
	$result = '';

	$images = scandir(WWW_DIR . $imgDir);


	foreach ($images as $image) {
		if(is_file(WWW_DIR . $imgDir . $image)) {
			$result .= render(TEMPLATES_DIR . 'galleryItem.tpl', [
				'src' => $imgDir . $image
			]);
		}
	}
	return $result;
}

function loadFile($fileName, $path){
	if(empty($_FILES[$fileName])|| $_FILES[$fileName]['erroe']){
		return 0;
	}

	$file = $_FILES[$fileName];
	$uploadDir = WWW_DIR . $path;
	$uploadfile = $uploadDir . basename($file['name']);

	if(move_uploaded_file($file['tmp_name'], $uploadfile)){
		return $path . basename($file['name']);
	}else{
		return 0;
	}

}

