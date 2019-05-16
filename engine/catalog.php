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

// function createReview($author, $text){

//     $link = createConnection();

//     $author = mysqli_real_escape_string($link, (string)htmlspecialchars(strip_tags($author)));
// 	$text = mysqli_real_escape_string($link, (string)htmlspecialchars(strip_tags($text)));

//     $sql = "INSERT INTO `reviews`(`author`, `text`) VALUES ('$author', '$text')";
    
//     $result = mysqli_query($link, $sql);
//     mysqli_close($link);
//     return $result;

// }

// function updateReview($id, $author, $text)
// {
// 	$link = createConnection();

// 	$id = (int)$id;
// 	$author = mysqli_real_escape_string($link, (string)htmlspecialchars(strip_tags($author)));
// 	$text = mysqli_real_escape_string($link, (string)htmlspecialchars(strip_tags($text)));

// 	$sql = "UPDATE `reviews` SET `author`='$author',`text`='$text' WHERE `id` = $id";

// 	$result = mysqli_query($link, $sql);

// 	mysqli_close($link);
// 	return $result;
// }

// function deleteReview($id)
// {
// 	$sql = "DELETE FROM `reviews` WHERE `id` = $id";

// 	$result = execQuery($sql);

// 	return $result;
// }