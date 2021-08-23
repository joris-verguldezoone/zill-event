<?php

namespace App\model;

require_once('model.php');


class Post extends Model
{

    public function createNewPost($titre, $description, $lien)
    {
        $id_admin = $_SESSION['admin']['id'];
        $tz_object = new \DateTimeZone('Europe/Paris');

        $date = new \DateTime();
        $date->setTimezone($tz_object);
        $date = $date->format('Y-m-d H:i:s');


        $sql = 'INSERT INTO post (titre, description, lien, id_admin, date) VALUES (:titre, :description, :lien, :id_admin, :date)';
        $result = $this->pdo->prepare($sql);
        $result->bindValue(':titre', $titre, \PDO::PARAM_STR);
        $result->bindValue(':description', $description, \PDO::PARAM_STR);
        $result->bindValue(':lien', $lien, \PDO::PARAM_STR);
        $result->bindValue(':id_admin', $id_admin, \PDO::PARAM_INT);
        $result->bindValue(':date', $date, \PDO::PARAM_STR);

        $result->execute();
    }
    public function updatePost($titre, $description, $lien, $id)
    {
        $sql = "UPDATE post set titre = :titre, description = :description, lien = :lien WHERE id = :id";
        $result = $this->pdo->prepare($sql);
        $result->bindValue(":titre", $titre, \PDO::PARAM_STR);
        $result->bindValue(":description", $description, \PDO::PARAM_STR);
        $result->bindValue(":lien", $lien, \PDO::PARAM_STR);
        $result->bindValue(":id", $id, \PDO::PARAM_INT);

        $result->execute();
    }
}
