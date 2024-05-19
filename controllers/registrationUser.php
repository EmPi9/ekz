<?php
   include_once './../models/connection.php';
   include_once './../models/authentication.php';
   
   $pdo = Connection::get()->connect();
   $auth = new Authentication($pdo);

   $email = $_POST['email'];
   $login = $_POST['login'];
   $name = $_POST['name'];
   $firstname = $_POST['firstname'];
   $password = $_POST['password'];
   $surname = $_POST['surname'];
   $number_phone = $_POST['number_phone'];
   $position = "Пользователь";
   $date_regist = date('d/m/y');

   $reppassword = $_POST['reppassword'];
   $error = null;

   
   $findUser = $auth->findUser($email);
 if ($email === '' || $name === '' || $firstname === '' || $password === '' || $reppassword === '') {    
     $error .= 'Заполните все поля  <br />';
  
 } else{
   
   if (filter_var($email, FILTER_VALIDATE_EMAIL)=== false) {
     $error .= "Email введен неверно.";
 } else{ 
   if (strlen($password) < 6) {
     $error .= 'Пароль меньше 6 <br />';
   } else {
     if ($password == $reppassword){
      if ($findUser) {
        $error .= 'Пользователь уже зарегистрирован <br />';
      } 
      else{
       $userId = $auth->register($name, $firstname, $surname, $number_phone,  $email, $login,$password, $date_regist, $position);
        echo "Вы успешно зарегистрировались";
       
      
      }
     } else {
      $error .= 'Пароли не совпадают <br />';
     }
       
     }
   }
   
 }
 if (!empty($error)) {
   http_response_code(400);
   echo $error;
   die();
}
 http_response_code(200);
?>