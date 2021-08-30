<?php

namespace App\Controller;

class Inscription extends Controller
{
    public function inscription($login, $password, $confirm_password)
    {
        $modelInscription = new \App\model\Inscription();
        $controllerInscription = new \App\controller\Inscription();

        $this->login = $controllerInscription->secure($login);
        $this->password = $controllerInscription->secure($password);        //securisé    

        $confirm_password = $controllerInscription->secure($confirm_password);                 // récupération valeurs $_POST, son droit est utilisateur a l'inscription
        $id_droits = 1; // initialisation a utilisateur classique

        $errorLog = null;
        if (!empty($login) && !empty($password) && !empty($confirm_password)) { // si les champs sont vides alors $errorLog

            $login_len = strlen($login);
            $password_len = strlen($password);
            $confirm_password_len = strlen($confirm_password);
            if (($login_len >= 2) && ($password_len >= 5) && ($confirm_password_len >= 4)) { // limite minimum de caractere

                if (($login_len <= 30) && ($password_len <= 30) && ($confirm_password_len <= 30)) { // limite maximum de caractere
                    $existLogin = $modelInscription->alreadyTakenCheck('admin', 'user_name', $login); // l'utilisateur existe-t-il ? 
                    if (!$existLogin) {
                        if ($confirm_password == $password) // si le mdp != confirm mdp alors $errorLog
                        {

                            $cryptedpass = password_hash($password, PASSWORD_BCRYPT); // CRYPTED 
                            $modelInscription->insert($login, $cryptedpass);

//                            echo 'GGWP'; // GG WP

                        } else $errorLog = "<p>Confirmation du mot de passe incorrect</p>";
                    } else $errorLog = "<p>Identifiant déjà utilisé</p>";
                } else $errorLog = "<p>mdp et identifiant limités a 30 caractères</p>";
            } else $errorLog = "<p>login, doit avoir 2 caracteres minimum, le mdp doit avoir 5 caracteres minimum</p>";
        } else {
            $errorLog = "<p>Champs non remplis</p>";
        }
        echo $errorLog;
    }
}
