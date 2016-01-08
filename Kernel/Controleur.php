<?php

require_once 'Configuration.php';
require_once 'Request.php';
require_once 'Vue.php';

abstract class Controleur
{
    /** Action to perform */
    private $action;

    /** Incoming request */
    protected $request;

    /**
     * Default action much be implemented by derived class
     */
    public abstract function index();

    public function setRequest(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Calls the method with the same name as the action on the current Controller object
     */
    public function performAction($action)
    {
        if (method_exists($this, $action))
        {
            $this->action = $action;
            $this->{$this->action}();
        }
        else
        {
            $classController = get_class($this);
            throw new Exception("Action : '$action' not defined in the class : $classController");
        }
    }

    /**
     * Generate view
     */
    protected function generateVue($viewData = array(), $action = null)
    {
        $viewAction = $this->action; // default action
        if ($action != null)
        {
            $viewAction = $action;
        }

        $classController = get_class($this); // current Controller
        $viewController = str_replace("Controleur", "", $classController);

        $vue = new Vue($viewAction, $viewController);
        $vue->generate($viewData);
    }

    /**
     * Redirects to a specific controller and action
     */
    protected function redirect($controller, $action = null)
    {
        $root = Configuration::get("root", "/");
        header("Location:" . $root . $controller . "/" . $action);
    }

}
