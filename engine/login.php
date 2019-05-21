<?php

require_once __DIR__ . '/../config/config.php';

// echo '<pre>';
// var_dump($_SESSION);
// echo '</pre>';


$login = $_POST['login'] ?? '';
$password = $_POST['password'] ?? '';

if($_SESSION['login']){
    // header('Location:/userAccount.php');
    die;
}


if($login && $password) {
    $password = md5($password);

    $sql = "SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$password'";
    $user = show($sql);
  
    if($user){
        $_SESSION['login'] = $user;
        // header('Location: http://gb-php1.site/userAccount.php');    
    }else{
        echo 'Неверный логин или пароль';
    }
}