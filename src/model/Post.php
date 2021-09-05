<?php

namespace App\model;


class Post extends Model
{

    public function createNewPost($titre, $description, $lien, $type, $lien_externe)
    {
        if (!empty($titre) && !empty($description) && !empty($lien) && !empty($type)) {
            $admin_login = $_SESSION['admin']['user_name'];
            $tz_object = new \DateTimeZone('Europe/Paris');

            $date = new \DateTime();
            $date->setTimezone($tz_object);
            $date = $date->format('Y-m-d H:i:s');


            $sql = 'INSERT INTO post (titre, description, lien, admin, date, type, lien_externe) VALUES (:titre, :description, :lien, :admin_login, :date, :type, :lien_externe)';
            $result = $this->pdo->prepare($sql);
            $result->bindValue(':titre', $titre, \PDO::PARAM_STR);
            $result->bindValue(':description', $description, \PDO::PARAM_STR);
            $result->bindValue(':lien', $lien, \PDO::PARAM_STR);
            $result->bindValue(':admin_login', $admin_login, \PDO::PARAM_STR);
            $result->bindValue(':date', $date, \PDO::PARAM_STR);
            $result->bindValue(':type', $type, \PDO::PARAM_STR);
            $result->bindValue(':lien_externe', $lien_externe, \PDO::PARAM_STR);

            $result->execute();
            return 'success';
        } else {
            return 'Il y a eu un problème.';
        }
    }

    public function updatePost($titre, $description, $lien, $id, $lien_externe)
    {
        $sql = "UPDATE post set titre = :titre, description = :description, lien = :lien , lien_externe = :lien_externe WHERE id = :id";
        $result = $this->pdo->prepare($sql);
        $result->bindValue(":titre", $titre, \PDO::PARAM_STR);
        $result->bindValue(":description", $description, \PDO::PARAM_STR);
        $result->bindValue(":lien_externe", $lien_externe, \PDO::PARAM_STR);
        $result->bindValue(":lien", $lien, \PDO::PARAM_STR);
        $result->bindValue(":id", $id, \PDO::PARAM_INT);

        $result->execute();
    }
}
