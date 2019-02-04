<?php

namespace Lib\Controllers;

class Controller {
    
    protected $template;
    protected $viewPath;

    public function render($view, $variables = []) {
        ob_start();
        extract($variables);
        require($this->viewPath . $view . '.php');
        $content = ob_get_clean();
        require($this->viewPath . 'templates/' . $this->template . '.php');
    }
}