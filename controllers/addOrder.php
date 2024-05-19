<?php
include_once './../models/order.php';

$id_user = $_POST['id_user'];
$description = $_POST['description'];
$id_status = 2;
$number_car= $_POST['number_car'];
$date_order = date('d/m/y');

addOrder($description, $id_user, $id_status, $date_order, $number_car);
header('Location: ./../index.php');