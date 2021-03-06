<?php

namespace App\Controller;

//require_once('controller.php');


class Admin extends Controller
{
    public function connexion($login, $password)
    {
        $login = $login;
        $password = $password;
        $errorLog = null;

        if (!empty($login) && !empty($password)) { // il faut remplir les champs sinon $errorLog

            $ControllerConnexion = new \App\controller\Admin();
            $modelConnexion = new \App\model\Admin();

            $login = $ControllerConnexion->secure($login);
            $password = $ControllerConnexion->secure($password);

            $fetch = $modelConnexion->checkOneValue('admin', 'user_name', $login); // savoir si le compte existe pour etre connecté
            if ($fetch) {
                $passwordSql = $modelConnexion->passwordVerifySql($login);

//                var_dump($password, $passwordSql);
                if (password_verify($password, $passwordSql['password'])) {
                    $_SESSION['connected'] = true;
                    $utilisateur = $modelConnexion->selectAllWhere('admin', 'user_name', $login);
                    $_SESSION['admin'] = $utilisateur; // la carte d'identité de l'utilisateur à été créer et initialisé dans une $_SESSION

                    // $this->id = $utilisateur['user']['id'];
                    // $this->login = $utilisateur['user']['login'];
                    // $this->email = $utilisateur['user']['email'];
                    // $this->id_right = $utilisateur['user']['id_right'];

                    // Delete session id & user

                    $this->redirect('admin'); // GG WP
                } else {
                    $errorLog = "<p class='alert alert-danger' role='alert'>Mot de passe incorrect</p>";
                }
            } else {
                $errorLog = "<p class='alert alert-danger' role='alert'>Identifiant incorrect</p>";
            }
        } else {
            $errorLog = "<p class='alert alert-danger' role='alert'>Veuillez entrer des caracteres dans les champs</p>";
        }
        return $errorLog; // on aurait pu mettre un return mais flemme :-) pour un prochain projet
    }
}
    // connexion
    // affichage plusieurs pages 
    // CRUD 
