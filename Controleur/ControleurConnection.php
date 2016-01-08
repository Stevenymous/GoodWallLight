<?php

require_once 'Kernel/Controleur.php';
require_once 'Modele/User.php';

class ControleurConnection extends Controleur
{
    private $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function index()
    {
        $this->generateVue();
    }

    public function connection()
    {
        if ($this->request->checkParameter("email") && $this->request->checkParameter("password"))
        {
            $email = $this->request->getParameter("email");
            $password = $this->request->getParameter("password");
            if ($this->user->checkUserExist($email, $password)) 
            {
                $user = $this->user->getUser($email, $password);
                $this->request->getSession()->setAttribute("userId", $user['userId']);
                $this->redirect("profile");
            }
            else
                $this->generateVue(array('errorMessage' => 'Incorrect Email or password... The email you entered does not belong to any account.'),"index");
        }
        else
            throw new Exception("Error : Email and password were undefined");
    }

    public function signup()
    {
        $this->generateVue();
    }

    public function signupConnection()
    {
        if ($this->request->checkParameter("email"))
        {
            $email = $this->request->getParameter("email");
            if ($this->user->checkUserExist($email))
            {
                $this->generateVue(array('errorMessage' => 'Oups... The email you entered already exist. Have you already a GoodWall Lite account ?'),"index");
            }
            else
            {
                $password = $this->request->getParameter("password");
                $firstName = $this->request->getParameter("firstName");
                $lastName = $this->request->getParameter("lastName");
                $birthDate = $this->request->getParameter("birthDate");
                $sex = $this->request->getParameter("sex");
                $location = $this->request->getParameter("location");
                $about = $this->request->getParameter("about");
                
                $this->user->addUser($firstName, $lastName, $birthDate, $sex, $location, $about, $email, $password);

                if ($this->user->checkUserExist($email, $password))
                {
                    $user = $this->user->getUser($email, $password);
                    $this->request->getSession()->setAttribute("userId", $user['userId']);
                    $this->redirect("profile");
                }
                else
                    $this->generateVue(array('errorMessage' => 'Sorry... There was a problem when adding datas in database, you must restart.'),"signup");
            }

        }
        else
            throw new Exception("Error : Email and password were undefined");
    }

    public function signOut()
    {
        $this->request->getSession()->destroy();
        $this->redirect("welcome");
    }

}