<?php

namespace App\Controller;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


class Controller
{
    protected $twig;

    public function home(Request $request, Response $response, $args)
    {
        $this->preloadTwig();
        $response->getBody()->write($this->twig->render('home.twig.html'));
        return $response;
    }

    public function about(Request $request, Response $response, $args)
    {
        $this->preloadTwig();
        $response->getBody()->write($this->twig->render('about.twig.html'));
        return $response;
    }

    public function skills(Request $request, Response $response, $args)
    {
        $this->preloadTwig();
        $response->getBody()->write($this->twig->render('skills.twig.html'));
        return $response;
    }


    public function testimonies(Request $request, Response $response, $args)
    {
        $this->preloadTwig();
        $response->getBody()->write($this->twig->render('testimonies.twig.html'));
        return $response;
    }

    public function event(Request $request, Response $response, $args)
    {

        $this->preloadTwig();
        $response->getBody()->write($this->twig->render('evenement.twig.html'));
        return $response;
    }


    public function request_path(Request $request, Response $response, $args)
    {
        $this->preloadTwig();
        $response->getBody()->write(__DIR__);
        return $response;
    }

    public function admin(Request $request, Response $response, $args)
    {
        $model = new \App\model\Post();


        $this->preloadTwig();
        if (isset($_SESSION['admin'])) {
            $allPost = $model->selectAllByOrder('post', 'date', 'DESC');
            $allEvent = $model->selectAllByOrder('event', 'id', 'ASC');
            // var_dump($allEvent);
            $EventController = new \App\controller\Event();
            $EventController->newEventPicutre();
            $allUser = $model->selectAllByOrder('admin', 'id', 'ASC');
            $login = $_SESSION['admin']['user_name'];
            $response->getBody()->write(
                $this->twig->render(
                    'admin.twig.html',
                    [
                        'HTTP_HOST' => HTTP_HOST, 'BASE_PATH' => BASE_PATH,
                        'allPost' => $allPost, 'allEvent' => $allEvent, 'login' => $login, 'allUser' => $allUser
                    ]
                )
            );
        } else {
            $response->getBody()->write($this->twig->render('admin_connexion.twig.html'));
        }
        return $response;
    }
    public function admin_connexion(Request $request, Response $response, $args)
    {
        $this->preloadTwig();

        $response->getBody()->write($this->twig->render('admin_connexion.twig.html'));
        return $response;
    }
    public function getConnexion(Request $request, Response $response, $args)
    {
        $method = $request->getMethod();
        $result = "";
        // $this->preloadTwig();
        if ($method == 'POST') {

            $params = (array)$request->getParsedBody();

            $login = $params['login'];
            $password = $params['password'];

            $connexionController = new \App\controller\Admin();
            $result = $connexionController->connexion($login, $password);
            if ($result == "succes") {
                // return $this->redirect('admin'); // GG WP
                // $response->getBody()->write($this->twig->render('admin.twig.html'));
                $response->getBody()->write($result);
                return $response;
            } elseif ($result = 'error_mdp') {

                $response->getBody()->write($result);
            } elseif ($result = 'error_log') {

                // $response->getBody()->write($result);
            } elseif ($result = 'error_char') {

                // $response->getBody()->write($result);
            }
        } else {
            $login = "";
            $password = "";
            // $response->getBody()->write('input error');
        }


        // return $response;
    }


    public function inscription_admin(Request $request, Response $response, $args)
    {
        $method = $request->getMethod();
        $result = '';
        if ($method == 'GET') {
            $login = $_GET['login'];
            $confirm_password = $_GET['confirm_password'];
            $password = $_GET['password'];
            //            var_dump($_GET);
            //            var_dump($login, $password);
            $admin = new \App\controller\Inscription();
            $result = $admin->inscription($login, $password, $confirm_password);
        } else {
            $login = '';
            $password = '';
        }

        $this->preloadTwig();
        $response->getBody()->write($result);
        return $response;
    }

    public function deconnexion(Request $request, Response $response, $args)
    {
        session_destroy();
        $this->redirect('home');
    }

    public function newPost(Request $request, Response $response, $args)
    {
        $method = $request->getMethod();

        if ($method == 'POST') {

            $params = (array)$request->getParsedBody();
            //var_dump($_POST);
            $lien_externe = $this->secure($_POST["lien_externe"]);
            $title = $this->secure($_POST['title']);
            $description = $this->secure($_POST['description']);
            $lien = preg_replace('/(<a\b[^><]*)>/i', '$1 sandbox">', $_POST['lien']);
            $type = $this->secure($_POST['type']);


            $newPostController = new \App\model\Post();
            $result = $newPostController->createNewPost($title, $description, $lien, $type, $lien_externe);
        } else {
            $title = "";
            $description = "";
            $lien = "";
            $lien_externe = "";
        }
        $this->preloadTwig();
        $response->getBody()->write($result);
        return $response;
    }


    public function blog(Request $request, Response $response, $args)
    {
        $model = new \App\model\Post();

        //var_dump($model);
        $allPost = $model->selectAllByOrder('post', 'date', 'DESC');
        // var_dump($allPost);

        $this->preloadTwig();
        $response->getBody()->write(
            $this->twig->render(
                'blog.twig.html',
                [
                    'HTTP_HOST' => HTTP_HOST, 'BASE_PATH' => BASE_PATH, 'allPost' => $allPost
                ]
            )
        );
        return $response;
    }


    public function article(Request $request, Response $response, $args) //récupère les data d'un article grâce à l'id dans l'url
    {
        $model = new \App\model\Post();
        $selectedPost = $model->selectPostById('post', $_GET['id']);
        //        var_dump($selectedPost);
        $suggestion = $model->selectRandLimit3('post'); // permet de récuperer des suggestion , 3, et aléatoires 
        $this->preloadTwig();
        //  var_dump($suggestion);
        if (!empty($selectedPost)) {
            $response->getBody()->write($this->twig->render(
                'article.twig.html',
                [
                    'HTTP_HOST' => HTTP_HOST, 'BASE_PATH' => BASE_PATH, 'selectedPost' => $selectedPost, 'suggestion' => $suggestion
                ]
            ));
        } else {
            $this->redirect('blog'); //si id non existant, redirection vers le blog
        }
        return $response;
    }


    public function modifyArticle(Request $request, Response $response, $args)
    {
        $method = $request->getMethod();
        if ($method == 'GET') {

            $params = (array)$request->getParsedBody();
            // var_dump($_GET);
            // var_dump($params);
            $model = new \App\model\Post();

            $lien_externe = $this->secure($_GET['lien_externe']);
            $titre = $this->secure($_GET['titre']);
            $description = $this->secure($_GET['description']);
            $lien = $this->secure($_GET['lien']);
            $id = $this->secure($_GET['id']);
            $model->updatePost($titre, $description, $lien, $id, $lien_externe);
            // var_dump($titre, $description, $lien);
        } else {
            $titre = "";
            $description = "";
            $lien = "";
        }

        // var_dump($_POST);
        $this->preloadTwig();
        $response->getBody()->write('Article modifié avec succès');

        return $response;
    }

    public function deletePost(Request $request, Response $response, $args)
    {
        $method = $request->getMethod();
        if ($method == 'get') {

            $params = (array)$request->getParsedBody();
            // var_dump($_GET);
            // var_dump($params);
            $model = new \App\model\Post();


            $id = $this->secure($_GET['id']);
            $model->deleteWhere('post', 'id', $id);
        } else {
            $id = "";
        }

        // var_dump($_POST);
        $this->preloadTwig();
        $response->getBody()->write($this->twig->render('admin.twig.html'));

        return $response;
    }

    public function modifAdmin(Request $request, Response $response, $args)
    {
        $method = $request->getMethod();
        if ($method == 'GET') {

            $params = (array)$request->getParsedBody();
            // var_dump($_GET);
            // var_dump($params);
            $model = new \App\model\Admin();

            $confirm_password = $this->secure($_GET['confirm_password']);
            $user_name = $this->secure($_GET['user_name']);
            $password = $this->secure($_GET['password']);
            $id = $this->secure($_GET['id']);
            $user_name_len = strlen($user_name);
            $password_len = strlen($password);
            $error = "";
            if ($confirm_password == $password) {

                if ($user_name_len > 2) {
                    if ($password_len > 4) {
                        $password = password_hash($password, PASSWORD_BCRYPT);
                        $model->updateTwoValue('admin', 'user_name', 'password', 'id', $user_name, $password, $id);
                        $succes = "Les données ont été modifiées avec succès";
                        $this->preloadTwig();

                        $response->getBody()->write($succes);
                        return $response;
                    } else {
                        $error = '<p>Le mdp doit comporter 4 caractères minimum</p>';
                    }
                } else {
                    $error =  '<p>Le login doit comporter 2 caractères minimum</p>';
                }
            } else {
                $error =  '<p>Confirmation du mot de passe incorrecte</p>';
            }
        }
        if ($error !== "") {
            $id = "";
            $user_name = "";
            $password = "";
            $confirm_password = "";
            $this->preloadTwig();
            $response->getBody()->write($error);
            return $response;
        }

        // var_dump($_POST);
        return $response;
    }

    public function deleteAdmin(Request $request, Response $response, $args)
    {


        $model = new \App\model\Admin();
        $id = $this->secure($_GET['id_delete']); // va devenir un string

        if (($id !== '1') && ($id !== $_SESSION['admin']['id'])) {

            $result = $model->deleteWhere('admin', 'id', $id);
            $this->preloadTwig();
            $response->getBody()->write('Admin supprimé !');
            return $response;
        } else {
            $this->preloadTwig();
            $response->getBody()->write("Vous ne pouvez pas vous supprimer vous même ou supprimer l'admin principal");
            return $response;
        }
    }

    public function deleteArticle(Request $request, Response $response, $args)
    {

        $model = new \App\model\Admin();
        $id = $this->secure($_GET['id_delete']);
        $result = $model->deleteWhere('post', 'id', $id);
        $this->preloadTwig();

        $response->getBody()->write('Article supprimé avec succès');
        return $response;
    }


    /**
     * Charge les fichiers .twig
     */
    public function preloadTwig()
    {
        $loader = new FilesystemLoader('views');
        $this->twig = new Environment($loader);

        $this->twig->addGlobal('session', $_SESSION);
        $this->twig->addGlobal('BASE_PATH', BASE_PATH);
        $this->twig->addGlobal('HTTP_HOST', HTTP_HOST);
    }

    /**
     * Permet de sécuriser les variables passer en paramètre
     */
    public function secure($var): string
    {
        return $var = htmlspecialchars(trim($var));
    }

    /**
     * Permet de rediriger l'utilisateur dans un chemin donné en paramètre
     */
    public function redirect(string $path)
    {
        header('location: ' . $path);
        exit();
    }
}

//$post = new Controller();
//var_dump($post->blog());
