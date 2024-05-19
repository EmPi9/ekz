<?php require 'layount/header.php';
include_once 'models\order.php';
$orders = getOrders();
$status = getStatus();
?>

<section class="my-24 w-4/5 mx-auto">
<h1 class="text-3xl">Заявления</h1>
<div class="flex flex-wrap gap-12">
    
    <?php foreach($orders as $order):?>
        <?php foreach($status as $stat):?>
        <?php if($order['id_user'] == $user['id_user']):?>
            <?php if($stat['id_status'] == $order['id_status']):?>
    <div class="my-12 border-4 w-2/6 border-blue-400 p-5 rounded-lg">
        <h1><b>Статус:</b> <?= $stat['status']?> </h1>
      <h1 class="text-xl my-4"><b>Номер авто:</b> <?= $order['number_car']?></h1>
      <p class="text-lg  overflow-auto break-words"><b>Описание:</b> <?= $order['description']?></p>
    </div>
    <?php endif?>
    <?php endif?>
    <?php endforeach?>
    <?php endforeach?>
</div>
</section>