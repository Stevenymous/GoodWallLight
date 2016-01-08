<?php

require_once 'Configuration.php';

class Vue
{
    /** View file */
    private $file;

    /** View title */
    private $title;

    /**
     * Constructor : check view file with controller action
     * View file convention : Vue/<$controller>/<$action>.php
     */
    public function __construct($action, $controller = "")
    {
        $file = "Vue/";
        if ($controller != "")
        {
            $file = $file . $controller . "/";
        }
        $this->file = $file . $action . ".php";
    }

    /**
     * Generate and show view
     * Generate the common basis + specific parts
     */
    public function generate($data)
    {
        $content = $this->generateFile($this->file, $data);
        $root = Configuration::get("root", "/");
        $vue = $this->generateFile('Vue/basis.php',
                array('title' => $this->title, 'content' => $content, 'root' => $root));
        echo $vue;
    }

    /**
     * Generate view file and return result
     */
    private function generateFile($file, $data)
    {
        if (file_exists($file))
        {
            extract($data);
            ob_start();
            require $file;
            return ob_get_clean();
        }
        else
        {
            throw new Exception("File : '$file' not found");
        }
    }

    /**
     * Avoids unwanted code execution problems (XSS) in views
     */
    private function secure($value)
    {
        return htmlspecialchars($value, ENT_QUOTES, 'UTF-8', false);
    }

}
