<?php
include_once './../models/connection.php';
include_once './../models/authentication.php';

$login = $_POST['login'];
$password = $_POST['password'];
$error = null;

$pdo = Connection::get()->connect();
$auth = new Authentication($pdo);
$auth->login($login, $password);

$comparePassword = $auth->comparePasswords($login, $password);


if ($login === '' || $password === '') {
    $error .= 'Заполните поля <br />';
} else{
    if (!$comparePassword) {
        $error .= ' ';
    }

}

if (!empty($error)) {
    http_response_code(400);
    echo $error;
    die();
    
} 
http_response_code(200);
echo 'Вы успешно вошли';



