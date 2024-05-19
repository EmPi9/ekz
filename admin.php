<?php require 'layount/header.php';
include_once 'models\order.php';
$orders = getOrders();
$status = getStatus();
?>


<section class="my-12 w-4/5 mx-auto text-center">
<section class="my-24 w-4/5 mx-auto">
<div class="my-6">
    <h1 class="text-3xl">Заявления</h1>
    <?php foreach($orders as $order):?>
      
    <div class="my-12  border-4 border-blue-400 flex justify-between w-full text-left p-5 rounded-lg ">
        <div class="w-3/5">
        <?php foreach($status as $stat):?>
            <?php if($stat['id_status'] == $order['id_status']):?>
        <h1><b>Статус:</b> <?= $stat['status']?> </h1>
        <?php endif?>
        <?php endforeach?>
        <h1 class="text-xl my-4"><b>Номер авто:</b> <?= $order['number_car']?></h1>
      <p class="text-lg  overflow-auto break-words"><b>Описание:</b> <?= $order['description']?></p>
        </div>
    <div class="my-4">
        <form action="./controllers/editStatus.php" method="post">
        <select name="id_status" id="id_status" class="bg-blue-700 text-white rounded-md px-4 py-2">
        <?php foreach($status as $stat):?>
            <option  value="<?= $stat['id_status']?>"><?= $stat['status']?></option>
            <?php endforeach?>
        </select>
        <input type="hidden" id="id_order" name="id_order" value="<?= $order['id_order']?>">
        <button type="submit" class="bg-blue-700 text-white rounded-md px-4 py-2">Подтвердить</button>
        </form>
       
    </div>
    </div>

    <?php endforeach?>
</div>
</section>


<?php require 'layount/footer.php'; ?>