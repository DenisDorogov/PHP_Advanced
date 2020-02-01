<?php


namespace app\controllers;

use app\engine\Render;
use app\interfaces\IRenderer;

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
                    'count' => Basket::getCountWhere('session_id', session_id()),
                    'auth' => Users::isAuth(),
                    'username' => Users::getName()
                ]),
                'content' => $this->renderTemplate($template, $params)
            ]);
        } else {
            return $this->renderTemplate($template, $params);
        }
    }

    public function renderTemplate($template, $params = [])
    {
//        ob_start(); TODO удалить коментарии
//        extract($params);
//        $templatePath = TEMPLATES_DIR . $template . ".php";
//        if (file_exists($templatePath)) {
//            include $templatePath;
//        }
//        return ob_get_clean();
        return $this->renderer->renderTemplate($template, $params);
    }

}