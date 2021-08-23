<?php

namespace App\model;

require_once('model.php');

class Event extends Model
{
    public function newEventPicture($picture, $id_event)
    {
        $sql = "UPDATE event SET path = :picture WHERE id = :id_event";
        $result = $this->pdo->prepare($sql);
        $result->bindValue(':picture', $picture, \PDO::PARAM_STR);
        $result->bindValue(':id_event', $id_event, \PDO::PARAM_INT);
        $result->execute();
    }
}
