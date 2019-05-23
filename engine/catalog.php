<?php

function getProducts(){
    $sql = "SELECT * FROM products";

    return getAssocResult($sql);
}

function showProduct($id){
    $id = (int)$id;
    $sql = "SELECT * FROM products WHERE id = $id";
    $product = getAssocResult($sql);
    if(!$product){
        return null;
    }
    return $product[0];
}

function renderProducts(){

    $result = "";
    $products = getProducts();

    foreach($products as $product){
        $result .= render(TEMPLATES_DIR . 'catalog.tpl', $product);
    }
    return $result;
}

function createProduct($name, $description, $price, $file){

    if($file['name']){
        $fileName = loadFile('image', 'img/products/');
    }

    $link = createConnection();

    $name = escapeString($link, $name);
    $description = escapeString($link, $description);
    $price = (float)$price;

    $sql = $fileName
    ? "INSERT INTO `products`(`name`, `description`, `price`, `image`) VALUES ('$name', '$description', '$price', '$fileName')"
    : "INSERT INTO `products`(`name`, `description`, `price`) VALUES ('$name', '$description', '$price')";
    
    return execQuery($sql, $link);

}

function updateProduct($name, $description, $price, $file, $id){

    if($file['name']){
        $fileName = loadFile('image', 'img/products/');
    }

    $link = createConnection();

    $name = escapeString($link, $name);
    $description = escapeString($link, $description);
    $price = (float)$price;

    $sql = $fileName
    ? "UPDATE `products` SET `name` = '$name', `description` ='$description', `price` = '$price', `image` = '$fileName' WHERE `id` = $id"
    : "UPDATE `products` SET `name` = '$name', `description` ='$description', `price` = '$price' WHERE `id` = $id";
    
    return execQuery($sql, $link);

}



function deleteProduct($id, $image)
{
    $path = WWW_DIR . $image;
    unlink("$path");
	$sql = "DELETE FROM `products` WHERE `id` = $id";

	$result = execQuery($sql);

	return $result;
}