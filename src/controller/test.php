<?php


namespace App\Controller;


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class test extends Controller
{
    public function test(Request $request, Response $response, $args)
    {
        $this->preloadTwig();
        $response->getBody()->write($this->twig->render('profil.twig.html'));
        return $response;
    }

    public function bonjour(Request $request, Response $response, $args)
    {
        $result = "bonjour ! :D";
        $this->preloadTwig();
        $response->getBody()->write($result);
        return $response;
    }
}