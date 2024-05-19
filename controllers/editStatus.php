
<?php
include_once './../models/order.php';

$id_status = $_POST['id_status'];
$id_order = $_POST['id_order'];


editStatus($id_status,$id_order);
header('Location: ./../index.php');