<?php

function getReviews(){
    $sql = "SELECT * FROM reviews";

    return getAssocResult($sql);
}

function showReview($id){
    $id = (int)$id;
    $sql = "SELECT * FROM reviews WHERE id = $id";
    $review = getAssocResult($sql);
    if(!$review){
        return null;
    }
    return $review[0];
}

function renderReviews(){

    $result = "";
    $reviews = getReviews();

    foreach($reviews as $review){
        $result .= render(TEMPLATES_DIR . 'reviewItem.tpl', $review);
    }
    return $result;
}

function createReview($author, $text){

    $link = createConnection();

    $author = mysqli_real_escape_string($link, (string)htmlspecialchars(strip_tags($author)));
	$text = mysqli_real_escape_string($link, (string)htmlspecialchars(strip_tags($text)));

    $sql = "INSERT INTO `reviews`(`author`, `text`) VALUES ('$author', '$text')";
    
    $result = mysqli_query($link, $sql);
    mysqli_close($link);
    return $result;

}

function updateReview($id, $author, $text)
{
	$link = createConnection();

	$id = (int)$id;
	$author = mysqli_real_escape_string($link, (string)htmlspecialchars(strip_tags($author)));
	$text = mysqli_real_escape_string($link, (string)htmlspecialchars(strip_tags($text)));

	$sql = "UPDATE `reviews` SET `author`='$author',`text`='$text' WHERE `id` = $id";

	$result = mysqli_query($link, $sql);

	mysqli_close($link);
	return $result;
}

function deleteReview($id)
{
	$sql = "DELETE FROM `reviews` WHERE `id` = $id";

	$result = execQuery($sql);

	return $result;
}