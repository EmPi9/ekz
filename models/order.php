<?php
include_once 'connection.php';

function addOrder($description, $id_user, $id_status, $date_order, $number_car){
    $pdo = Connection::get()->connect();
    $sql = 'INSERT INTO ekzamen.order
    (description, id_user,id_status, date_order, number_car)
    VALUES(:description, :id_user, :id_status, :date_order, :number_car)';
    $statement = $pdo->prepare($sql);
    $statement->bindValue(":description", $description);
    $statement->bindValue(":id_user", $id_user);
    $statement->bindValue(":id_status", $id_status);
    $statement->bindValue(":date_order", $date_order);
    $statement->bindValue(":number_car", $number_car);
    $statement->execute();
}
function editStatus($id_status,$id_order){
    $pdo = Connection::get()->connect();
    $sql = 'UPDATE ekzamen.order
    SET id_status = :id_status
    WHERE id_order = :id_order';
    $statement = $pdo->prepare($sql);
    $statement->bindValue(":id_status", $id_status);
    $statement->bindValue(":id_order", $id_order);
    $statement->execute();
}
function getOrders() {
    $pdo = Connection::get()->connect();
    $sql = 'SELECT * FROM ekzamen.order ' ;
    $statement = $pdo->prepare($sql);
    $statement->execute();
    $ord = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $ord;
}

function getStatus() {
    $pdo = Connection::get()->connect();
    $sql = 'SELECT * FROM ekzamen.status ' ;
    $statement = $pdo->prepare($sql);
    $statement->execute();
    $ord = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $ord;
}