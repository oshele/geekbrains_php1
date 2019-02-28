<?php

function getImages()
{
	$sql = "SELECT * FROM `images` ORDER BY `views` DESC";

	return getAssocResult($sql);
}

function getImage($id)
{
	$sql = "SELECT * FROM `images` WHERE `id` = $id";

	return show($sql);
}

function updateViews($id, $views = false)
{
	$viewsString = $views ? (int)$views : '`views` + 1';

	$sql = "UPDATE `images` SET `views` = $viewsString WHERE `id` = $id";

	return execQuery($sql);
}


function createGallery()
{
	$result = '';
	$images = getImages();

	foreach ($images as $image) {
		if(is_file(WWW_DIR . $image['url'])) {
			$result .= render(TEMPLATES_DIR . 'galleryItem.tpl', $image);
		}
	}
	return $result;
}

function showImage($id)
{
	$image = getImage($id);

	if(!$image) {
		return '404';
	}

	updateViews($id);
	$image['views']++;

	return render(TEMPLATES_DIR . 'imagePage.tpl', $image);
}
