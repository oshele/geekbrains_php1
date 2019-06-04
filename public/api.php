<?php
require_once __DIR__ . '/../config/config.php';

function success($data = true)
{
	echo "OK";
	exit();
}

function error($error_text)
{
	echo "Ошибка: $error_text";
	exit();
}

if (empty($_POST['apiMethod'])) {
	error('Не передан apiMethod');
}

if ($_POST['apiMethod'] === 'login') {
	$login = $_POST['postData']['login'] ?? '';
	$password = $_POST['postData']['password'] ?? '';

	if (!$login || !$password) {
		error('Не передан логин или пароль');
	}

	$password = md5($password);

	$sql = "SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$password'";
	$user = show($sql);

	if ($user) {
		$_SESSION['login'] = $user;
		success();
	} else {
		error('Неверный логин или пароль');
	}
}

if ($_POST['apiMethod'] === 'register') {
	$login = $_POST['postData']['login'] ?? '';
	$password = $_POST['postData']['password'] ?? '';
	$name = $_POST['postData']['name'] ?? '';

	if (!$login || !$password || !$name) {
		error('Неполные данные, пожалуйста, заполните форму');
	}
	$password = md5($password);

	$sql = "SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$password'";
	$user = show($sql);

	if (!$user) {
		$db = createConnection();
		$newLogin = escapeString($db, $login);
		$newName = escapeString($db, $name);

		$sql = "INSERT INTO `users`(`name`, `login`, `password`) VALUES ('$name', '$login', '$password')";

		$result = execQuery($sql, $db);

		if ($result) {
			$sql = "SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$password'";
			$user = show($sql);
			$_SESSION['login'] = $user;
			success();
		} else {
			error('Ошибка при регистрации');
		}
	} else {
		error('Пользователь с такими данными существует');
	}
}
