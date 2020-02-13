<?php


namespace app\controllers;

use app\engine\Render;
use app\interfaces\IRenderer;
use app\models\Basket;
use app\models\repositories\BasketRepository;
use app\models\repositories\UsersRepository;
use app\models\Users;

abstract class Controller
{
    private $action;
    private $defaultAction = 'index';
    private $layout = 'main';
    private $useLayout = true;
    private $renderer;

    public function __construct(IRenderer $renderer)
    {
        $this->renderer = $renderer;
    }

    public function runAction($action = null)
    {
        $this->action = $action ?: $this->defaultAction;
        $method = "action" . ucfirst($this->action);
        if (method_exists($this, $method)) {
            $this->$method();
        }
    }

    public function render($template, $params = []) {
        if ($this->useLayout) {
            return $this->renderTemplate("layouts/{$this->layout}", [
                'menu' => $this->renderTemplate('menu', [
                    'count' => (new BasketRepository())->getCountWhere('session_id', session_id()),
                    'auth' => (new UsersRepository())->isAuth(),
                    'username' => (new UsersRepository())->getName()
                ]),
                'content' => $this->renderTemplate($template, $params)
            ]);
        } else {
            return $this->renderTemplate($template, $params);
        }
    }
    public function renderTemplate($template, $params = [])
    {
        return $this->renderer->renderTemplate($template, $params);
    }

}