<?php

require_once 'Controleur.php';
require_once 'Request.php';
require_once 'Vue.php';

/**
 * Front-Controller : to dispatch all incoming requests
 */
class Dispatcher
{

    /**
     * Inspects Request and performs the appropriate action
     */
    public function requestDispatcher()
    {
        try {
            $request = new Request(array_merge($_GET, $_POST));

            $controleur = $this->createController($request);
            $action = $this->createAction($request);

            $controleur->performAction($action);
        }
        catch (Exception $e) {
            $this->error($e);
        }
    }

    /**
     * Create controller instance
     * Convention controllers files : Controleur/Controleur<$controleur>.php
     * With RewriteRules urls look like : index.php?controleur=...&action=...&id=...
     */
    private function createController(Request $request)
    {
        $controleur = "Welcome";  // default controller
        if ($request->checkParameter('controleur'))
        {
            $controleur = $request->getParameter('controleur');
            $controleur = ucfirst(strtolower($controleur));
        }
        $classControleur = "Controleur" . $controleur;
        $fileController = "Controleur/" . $classControleur . ".php";
        if (file_exists($fileController))
        {
            require($fileController);
            $controleur = new $classControleur();
            $controleur->setRequest($request);
            return $controleur;
        }
        else
        {
            throw new Exception("File '$fileController' not found");
        }
    }

    /**
     * Based on the recieved request, determines the action to perform
     */
    private function createAction(Request $request)
    {
        $action = "index";  // default action
        if ($request->checkParameter('action'))
        {
            $action = $request->getParameter('action');
        }
        return $action;
    }

    /**
     * Exception handling
     */
    private function error(Exception $exception)
    {
        $vue = new Vue('error');
        $vue->generate(array('errorMessage' => $exception->getMessage()));
    }

}