<?php

require_once '../config/config.php';

echo '<pre>';
var_dump($_POST);
echo '</pre>';

$title = $_POST['title'] ?? '';
$content = $_POST['content'] ?? '';

if($title && $content) {
	$result = insertItem($title, $content);

	if($result) {
		echo 'Статья добавлена';
		$title = '';
		$content = '';
	} else {
		echo 'Произошла ошибка';
	}
}

if(empty($title)) {
	echo 'Введите заголовок<br>';
}
if(empty($content)) {
	echo 'Введите контент<br>';
}

?>
<hr>
<form action="" method="POST">
	<div>
		Title: <input type="text" name="title" value="<?= $title ?>">
	</div>
	<div>
		Content:
		<textarea name="content" cols="30" rows="10"><?= $content ?></textarea>
	</div>
	<div>
		<input type="submit">
	</div>
</form>
