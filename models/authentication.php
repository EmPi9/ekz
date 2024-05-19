<?php

class Authentication{
    private $pdo;
    private $hash = 'markpetrunin';

    public function __construct($pdo){
        $this->pdo = $pdo;
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }
    public function findUser($login){
        $sql = 'SELECT id_user, "name", firstname, surname, number_phone, email, login, "password", date_regist, "position"
        FROM ekzamen.user WHERE login = :login LIMIT 1';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':login', $login);
        $stmt->execute();
        $row_count = $stmt->rowCount();
        if($row_count !== 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        return false;
    }

    public function register($name, $firstname, $surname, $number_phone,  $email, $login,$password, $date_regist, $position){
        $findUser = $this->findUser($login);
        $password = md5($password . $this->hash);
        if ($findUser === false){
            $sql = 'INSERT INTO ekzamen.user
            ( name, firstname, surname, number_phone, email, login, "password", date_regist, "position") VALUES ( :name, :firstname, :surname, :number_phone, :email, :login, :password, :date_regist, :position)';
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':name', $name);
            $stmt->bindValue(':firstname', $firstname);
            $stmt->bindValue(':surname', $surname);
            $stmt->bindValue(':number_phone', $number_phone);
            $stmt->bindValue(':email', $email);
            $stmt->bindValue(':login', $login);
            $stmt->bindValue(':password', $password);
            $stmt->bindValue(':date_regist', $date_regist);
            $stmt->bindValue(':position', $position);
            $stmt->execute();
            $_SESSION['user'] = $login;

           
        }
        return false;
    }
    public function comparePasswords($login, $oldPassword) {
        $sql = 'SELECT id_user, password FROM ekzamen.user WHERE login = :login LIMIT 1';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':login', $login);
        $stmt->execute();
        $row_count = $stmt->rowCount();
        if($row_count !== 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            $oldPassword = md5($oldPassword . $this->hash);
            if ($user['password'] !== $oldPassword) {
                return false;
            }
            return true;
        }
        return false;
    }


    public function login($login, $password){
        $findUser = $this->findUser($login);
        $password = md5($password . $this->hash);
        if ($findUser !== null){
            $sql = 'SELECT * FROM ekzamen.user WHERE login = :login AND password = :password LIMIT 1';
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':login', $login);
            $stmt->bindValue(':password', $password);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            $row_count = $stmt->rowCount();
            if($row_count === 1) {
                $_SESSION['user'] = $user['login'];
                return true;
            }
        }
        return false;
    }
    
    public function logout() {
        unset($_SESSION['user']);
 
    }

    public function isAuthed() {
        if (array_key_exists('user', $_SESSION) && $_SESSION['user'] !== null) {
            return true;
        } else {
            return false;
        }
    }

    public function getCurrentUser() {
        if ($this->isAuthed()) {
            return $this->findUser($_SESSION['user']);
        }
        return false;
    }

   
}






