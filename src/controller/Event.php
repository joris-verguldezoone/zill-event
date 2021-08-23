<?php

namespace App\Controller;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class Event extends Controller
{

    public function showEvenements()
    {
    }
    public function newEventPicutre()
    {
        if (isset($_FILES['picture']) and !empty($_FILES['picture']['name'])) {
            $lengthMax = 5000000;
            $validExt = array('jpg', 'jpeg', 'gif', 'png');
            var_dump($_FILES);
            var_dump($_POST);
            if ($_FILES['picture']['size'] <= $lengthMax) {
                $uploadExt = strtolower(substr(strrchr($_FILES['picture']['name'], '.'), 1));
                if (in_array($uploadExt, $validExt)) {
                    $date = date("Y-m-d_H:i:s");
                    $correctDate = str_replace(':', '-', $date);
                    $type_img = $_POST['hiddenType'];
                    $id_picture = $_POST['hiddenId'];
                    $path = BASE_PATH . '/upload/' . $type_img . "." . $uploadExt;
                    file_put_contents($_FILES['picture']['tmp_name'], $path);

                    $update = new \App\model\Event();
                    $update->newEventPicture($path, $id_picture);

                    echo ("Modification de votre photo de profil avec succès.");
                } else {
                    echo ("Votre photo de profil doit être au bon format <i>(jpg, jpeg, gif ou png)</i>.");
                }
            } else {
                echo ("Votre photo de profil ne doit pas dépasser 5Mo <i>(Méga-Octets)</i>.");
            }
        }
    }
}
