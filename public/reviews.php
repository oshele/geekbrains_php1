<?php

require_once '../config/config.php';



$author = $_POST['author'] ?? '';
$content = $_POST['content'] ?? '';

if($author && $content) {
	$result = insertReview($author, $content);

	if ($result) {
		echo 'Отзыв добавлен';
		$author = '';
		$content = '';
	} else {
		echo 'Произошла ошибка';
	}
}

echo '<hr>';

$reviews = getReviews();

foreach ($reviews as $review) {
	echo '<div>';
	echo "<div>{$review['author']}</div>";
	echo "<div>{$review['comment']}</div>";
	echo '</div>';
	echo '<hr>';
}


?>
<hr>
<form action="" method="POST">
	<div>
		Title: <input type="text" name="author" value="<?= $author ?>">
	</div>
	<div>
		Content:
		<textarea name="content" cols="30" rows="10"><?= $content ?></textarea>
	</div>
	<div>
		<input type="submit">
	</div>
</form>


