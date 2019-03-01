<?php


function getReviews()
{

	$sql = "SELECT * FROM `reviews` ORDER BY `date` DESC";

	return getAssocResult($sql);
}

function insertReview($author, $content)
{

	$db = createConnection();
	$author = escapeString($db, $author);
	$content = escapeString($db, $content);

	$sql = "INSERT INTO `reviews`(`author`, `comment`) VALUES ('$author', '$content')";

	return execQuery($sql, $db);
}
