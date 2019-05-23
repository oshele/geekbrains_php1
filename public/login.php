<?php

require_once __DIR__ . '/../config/config.php';


$login = $_POST['login'] ?? '';
$password = $_POST['password'] ?? '';
$newName = $_POST['newName'] ?? '';
$newLogin = $_POST['newLogin'] ?? '';
$newPassword = $_POST['newPassword'] ?? '';

if($_SESSION['login']){
    header('Location: /userAccount.php');
}


if($login && $password) {
    $password = md5($password);

    $sql = "SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$password'";
    $user = show($sql);
  
    if($user){
        $_SESSION['login'] = $user;
        header('Location: /userAccount.php');   
    }else{
        echo 'Неверный логин или пароль';
    }
}

if($newLogin && $newPassword && $newName) {

    $newPassword = md5($newPassword);

    $sql = "SELECT * FROM `users` WHERE `login` = '$newLogin' AND `password` = '$newPassword'";
    $user = show($sql);

      
    if(!$user){
        $db = createConnection();
        $newLogin = escapeString($db, $newLogin);
        $newName = escapeString($db, $newName);

        $sql = "INSERT INTO `users`(`name`, `login`, `password`) VALUES ('$newName', '$newLogin', '$newPassword')";
        
        $result = execQuery($sql, $db);

        if($result){
            $sql = "SELECT * FROM `users` WHERE `login` = '$newLogin' AND `password` = '$newPassword'";
            $user = show($sql);
            $_SESSION['login'] = $user;
            header('Location: /userAccount.php');
        }else{
            echo 'Ошибка при регистрации';
        }
    
    }else{
        echo 'Пользователь с такими данными существует';
    }
}else {
    echo 'Недостаточно данных';
}





echo render(TEMPLATES_DIR . 'index.tpl', [
	'title' => 'Вход в личный кабинет',
	'h1' => 'Вход в личный кабинет',
	'content' => render(TEMPLATES_DIR . 'login.tpl', []),
	'style' => 'css/style.css',
]);