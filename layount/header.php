
<?php 
include_once './models/connection.php';
include_once './models/authentication.php';
session_start();

$pdo = Connection::get()->connect();
$auth = new Authentication($pdo);
$user = $auth->getCurrentUser();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Нарушителям.нет</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <header>
        <nav class="my-12 mx-24 flex justify-between">
            <div>
            <a href="index.php" class="mx-10">Главная</a>
            <a href="order.php " class="mx-10">Заявления</a>
          
          
            </div>
            <?php if(!isset($_SESSION['user'])): ?>
           <div>
           <a href="regist.php" class="mx-10 bg-red-400 text-white py-4 px-10">Регистрация</a>
            <a href="autoriz.php" class="mx-10 bg-red-700 text-white py-4 px-10">Авторизация</a>
           </div>
           <?php elseif($user['position'] == 'Пользователь'): ?>
            <div>
            <a href="profile.php" class="mx-10">Личный кабинет</a>
            <a href="./controllers/logout.php" class="bg-blue-700 loginBtn py-2 px-[22px] text-base font-medium text-white hover:opacity-70">
            Выйти
                </a>
           </div>
           <?php elseif($user['position'] == 'Администратор'): ?>
            <div>
            <a href="admin.php" class="mx-10">Админ-панель</a>
            <a href="./controllers/logout.php" class="bg-blue-700 loginBtn py-2 px-[22px] text-base font-medium text-white hover:opacity-70">
                 Выйти
                </a>
           </div>
            <?php endif; ?>

        </nav>
    </header>