<?php

require_once 'Kernel/Controleur.php';

abstract class ControleurSecure extends Controleur
{
    /**
     * Check session : if the user is not connected, redirect to connection page 
     */
    public function performAction($action)
    {
        if ($this->request->getSession()->checkAttributeExist("userId"))
        {
            parent::performAction($action);
        }
        else
        {
            $this->redirect("connection");
        }
    }

}