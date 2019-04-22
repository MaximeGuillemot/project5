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

        if(file_exists($this->viewPath . $view . '-aside.php')) {
            ob_start();
            require($this->viewPath . $view . '-aside.php');
            $asideContent = ob_get_clean();
        } else {
            ob_start();
            require($this->viewPath . 'templates/aside.php');
            $asideContent = ob_get_clean();
        }
        
        require($this->viewPath . 'templates/' . $this->template . '.php');
    }
}