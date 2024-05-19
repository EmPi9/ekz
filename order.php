<?php require 'layount/header.php'; ?>


<section class="my-12 w-4/5 mx-auto text-center">
<form action="./controllers/addOrder.php" method="post">
    <h2 class="text-3xl">Заявление</h2>
    <div class="regist my-6">
    <div class="my-4 block">
        <input type="text" id="number_car" name="number_car" placeholder="Номер автомобиля" class="border-blue-500 border-2 rounded-md w-64 h-12">
    </div>
    <input type="hidden" id="id_user" name="id_user" value="<?= $user['id_user']?>">
    <div class="my-4 block">
        <textarea name="description" id="description" class="h-32 w-full border-blue-500 border-2 rounded-md"></textarea>
    </div>
    <div class=" mt-3 d-none text-white bg-green-500" id="successBlock"></div>
    <div class="mt-3 d-none text-white bg-red-500" id="errorBlock"></div>
    <div class="my-4 block">
        <?php if(!isset($_SESSION['user'])):?>
            <a href="autoriz.php" class="bg-blue-700 text-white rounded-md w-64 h-12">Отправить</a>
        <?php else:?>
           
            <button type="submit" class="bg-blue-700 text-white rounded-md w-64 h-12">Отправить</button>
        <?php endif?>
    </div>
    </div>

</form>
</section>


<?php require 'layount/footer.php'; ?>