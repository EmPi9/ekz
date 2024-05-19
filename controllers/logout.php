<?php
include_once './../models/connection.php';
include_once './../models/authentication.php';

$pdo = Connection::get()->connect();
$auth = new Authentication($pdo);
$auth->logout();

header('Location: ./../index.php');