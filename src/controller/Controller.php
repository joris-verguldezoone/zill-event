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
     *
     * @param $var
     * @return string
     */
    public function secure($var): string
    {
        return $var = htmlspecialchars(trim($var));
    }

    /**
     * Permet de rediriger l'utilisateur dans un chemin donné en paramètre
     *
     * @param string $path
     */
    public function redirect(string $path)
    {
        header('location: ' . $path);
        exit();
    }
}
