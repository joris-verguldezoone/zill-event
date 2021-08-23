<?php

namespace App\model;

require_once('model.php');

class Admin extends Model
{
    public function admin_connexion($login, $password)
    {
        $sql = "INSERT INTO admin (user_name,password) VALUES (:login,:password)";
        $result = $this->pdo->prepare($sql);
        $result->bindValue(':login', $login, \PDO::PARAM_STR);
        $result->bindValue(':password', $password, \PDO::PARAM_STR);

        // return $_SESSION
        $sql2 = "SELECT login FROM admin WHERE login = :login";
        $result2 = $this->pdo->prepare($sql2);
        $result2->bindValue(':login', $login, \PDO::PARAM_STR);

        $fetch = $result2->fetchAll();

        return $fetch;
    }
}
