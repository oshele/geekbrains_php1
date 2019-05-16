<?php

require_once __DIR__ . '/../config/config.php';

$author = isset($_POST['author']) ? $_POST['author'] : '';
$text = isset($_POST['text']) ? $_POST['text'] : '';

if ($author && $text) {
	if (createReview($author, $text)) {
		$messages .= "Комментарий добавлен";
		$author = '';
		$text = '';
	} else {
		$messages .= "Что-то пошло не так";
	}
} else {
	if (!$author) {
		$messages .= "Введите имя<br>";
	}
	if (!$text) {
		$messages .= "Добавьте Комментарий<br>";
	}
}



$reviewsContent = renderReviews();

echo render(TEMPLATES_DIR . 'index.tpl', [
	'title' => 'Комментарии',
	'h1' => 'Комментарии',
	'content' => $reviewsContent,
]);

?>

<div class="messages">
	<?= $messages ?>
</div>
<br>
<form method="POST">
	Имя:<br>
	<input type="text" name="author" value="<?= $author ?>"><br>
	Комментарий: <br>
	<textarea name="text"><?= $text ?></textarea><br>
	<br>
	<input type="submit">
</form>