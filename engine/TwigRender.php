<?php


namespace app\engine;


use app\interfaces\IRenderer;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

class TwigRender implements IRenderer
{   private $twig;

    public function __construct()
    {
        $loader = new FilesystemLoader('../twigtemplates');
        $this->twig = new Environment($loader);
    }
    public function renderTemplate($template, $params = []) {
        return $this->twig->render($template . '.twig', $params);
    }
}