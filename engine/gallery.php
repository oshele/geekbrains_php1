<?php

function getImages(){
	$sql = "SELECT * FROM images ORDER BY images.views DESC";
	return getAssocResult($sql);
}


function renderGallery($images){

    $gallery = '';

    foreach ($images as $image){

     $gallery .= render(TEMPLATES_DIR . 'galleryItem.tpl', [
         'id' => $image['id'],
         'src' => $image['url'],
         'image_title' => $image['title'],
         'views' => $image['views'],
     ]);

    }
    return $gallery;
}

function increaseViews($id, $galleryItem){
    $i = $galleryItem['views'];
    $i += 1;
    execQuery("UPDATE `images` SET `views` = $i WHERE `id` = $id");
};