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
        $allPost = $model->selectAllByOrder('post', 'date', 'DESC');
        $this->preloadTwig();
        $allEvent = $model->selectAllByOrder('event', 'id', 'ASC');
        // var_dump($allEvent);
        $EventController = new \App\controller\Event();
        $EventController->newEventPicutre();

        if (isset($_SESSION['admin'])) {
            $login = $_SESSION['admin']['user_name'];
            $response->getBody()->write(
                $this->twig->render(
                    'admin.twig.html',
                    [
                        'HTTP_HOST' => HTTP_HOST, 'BASE_PATH' => BASE_PATH, 'allPost' => $allPost, 'allEvent' => $allEvent, 'login' => $login
                    ]
                )
            );
        } else {
            $response->getBody()->write($this->twig->render('admin_connexion.twig.html'));
        }
        return $response;
    }

    public function getConnexion(Request $request, Response $response, $args)
    {
        $method = $request->getMethod();
        if ($method == 'POST') {

            $params = (array)$request->getParsedBody();

            $login = $params['login'];
            $password = $params['password'];

            $connexionController = new \App\controller\Admin();
            $connexionController->connexion($login, $password);
        } else {
            $login = "";
            $email = "";
            $password = "";
            $confirm_password = "";
        }

        $this->preloadTwig();
        $response->getBody()->write($this->twig->render(
            'admin_connexion.twig.html',
            ['BASE_PATH' => BASE_PATH, 'method' => $method, 'login' => $login, 'password' => $password, "HTTP_HOST" => HTTP_HOST]
        ));
        return $response;
    }


    public function inscription_admin(Request $request, Response $response, $args)
    {
        $method = $request->getMethod();
        if ($method == 'GET') {
            $params = (array)$request->getParsedBody();
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
        $response->getBody('bonjour');
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

            $title = $this->secure($_POST['title']);
            $description = $this->secure($_POST['description']);
            $lien = $this->secure($_POST['lien']);

            $newPostController = new \App\model\Post();
            $newPostController->createNewPost($title, $description, $lien);
        } else {
            $title = "";
            $description = "";
            $lien = "";
        }
        $response->getBody();
        return $response;
    }

    public function blog(Request $request, Response $response, $args)
    {

        $model = new \App\model\Post();
        $allPost = $model->selectAllByOrder('post', 'date', 'DESC');
//        var_dump($allPost);

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
        $this->preloadTwig();
        if (!empty($selectedPost)) {
            $response->getBody()->write($this->twig->render('article.twig.html',
                [
                    'HTTP_HOST' => HTTP_HOST, 'BASE_PATH' => BASE_PATH, 'selectedPost' => $selectedPost
                ]));
        } else {
            $this->redirect('blog'); //si id non existant, redirection vers le blog
        }
        return $response;
    }


    public function admin_post_modify(Request $request, Response $response, $args)
    {
        $method = $request->getMethod();
        if ($method == 'GET') {

            $params = (array)$request->getParsedBody();
            // var_dump($_GET);
            // var_dump($params);
            $model = new \App\model\Post();


            $titre = $this->secure($_GET['titre']);
            $description = $this->secure($_GET['description']);
            $lien = $this->secure($_GET['lien']);
            $id = $this->secure($_GET['id']);
            $model->updatePost($titre, $description, $lien, $id);
            var_dump($titre, $description, $lien);
        } else {
            $titre = "";
            $description = "";
            $lien = "";
        }

        // var_dump($_POST);
        $this->preloadTwig();
        $response->getBody()->write($this->twig->render('admin.twig.html'));

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
