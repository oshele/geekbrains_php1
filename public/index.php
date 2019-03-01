<?php

require_once '../config/config.php';

echo '<pre>';
var_dump($_POST);
var_dump($_FILES);
echo '</pre>';

if(!empty($_FILES['userfile']) && !$_FILES['userfile']['error']) {
	$file = $_FILES['userfile'];

	$uploaddir = WWW_DIR . '/uploads/';

	$uploadfile = $uploaddir . basename($file['name']);
	if (move_uploaded_file($file['tmp_name'], $uploadfile)) {
		echo "Файл корректен и был успешно загружен.\n";
	} else {
		echo "Возможная атака с помощью файловой загрузки!\n";
	}
}

?>

<form action="" method="POST">
	<input type="submit" name="var1">
	<input type="submit" name="var2">
</form>

<form enctype="multipart/form-data" action="" method="POST">
	<!-- Поле MAX_FILE_SIZE должно быть указано до поля загрузки файла (в байтах) -->
	<!--	<input type="hidden" name="MAX_FILE_SIZE" value="30000" />-->
	<!-- Название элемента input определяет имя в массиве $_FILES -->
	Отправить этот файл: <input name="userfile" type="file" />
	<input type="submit" value="Send File" />
</form>
