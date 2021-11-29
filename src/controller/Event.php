<?php

namespace App\Controller;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class Event extends Controller
{

    // public function showEvenements()
    // {
    // }
    public function newEventPicutre()
    {
        // var_dump('bruh');
        if (isset($_FILES['picture']) and !empty($_FILES['picture']['name'])) {
            $lengthMax = 2000000;
            $validExt = array('jpg', 'jpeg', 'gif', 'png');
            // var_dump($_FILES);
            // var_dump($_POST);
            if ($_FILES['picture']['size'] <= $lengthMax && $_FILES['picture']['size'] != 0) {
                $uploadExt = strtolower(substr(strrchr($_FILES['picture']['name'], '.'), 1));
                if (in_array($uploadExt, $validExt)) {

                    $type_img = strtoupper($_POST['hiddenType']);
                    $id_picture = $_POST['hiddenId'];
                    $path = 'media/events/' . $type_img . "." . $uploadExt;
                    // a revoir pendant le transfert et push, 
                    // utiliser var_dump(getcwd()); pour connaitre son PATH 
                    
                    move_uploaded_file($_FILES['picture']['tmp_name'], $path);
                    // var_dump($path);
                    // var_dump($id_picture);
                    // var_dump($uploadExt);

                    // var_dump($result);
                    // getcwd();
                    // var_dump(getcwd());

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
