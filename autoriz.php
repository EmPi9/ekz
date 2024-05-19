<?php require 'layount/header.php'; ?>

<section class="my-12 w-4/5 mx-auto text-center">
<form id="registerform" method="post">
    <h2 class="text-3xl">Регистрация</h2>
    <div class="regist my-6">
    <div class="my-4 block">
        <input type="text" id="login" name="login" placeholder="Имя" class="border-blue-500 border-2 rounded-md w-64 h-12">
    </div>
    <div class="my-4 block">
        <input type="password" id="password" name="password" placeholder="Пароль" class="border-blue-500 border-2 rounded-md w-64 h-12">
    </div>
    <div class=" mt-3 d-none text-white bg-green-500" id="successBlock"></div>
                      <div class="mt-3 d-none text-white bg-red-500" id="errorBlock"></div>
    <div class="my-4 block">
        <button type="submit" class="bg-blue-700 text-white rounded-md w-64 h-12">Авторизоваться</button>
    </div>
    </div>

</form>
</section>

<script>
        registerform.onsubmit = async (event) => {
      event.preventDefault();

      let response = await fetch('./controllers/loginUser.php', {
        method: 'POST',
        body: new FormData(registerform)
      });

      let result = await response.text();

      if (response.status === 200) {
        errorBlock.classList.add('d-none');
        successBlock.classList.remove('d-none');
        successBlock.innerHTML = result;
        window.location.href = 'index.php';
      }
      if (response.status === 400) {
        successBlock.classList.add('d-none');
        errorBlock.classList.remove('d-none');
        errorBlock.innerHTML = result;
      }

    };
    </script>
