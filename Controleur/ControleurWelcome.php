<?php

require_once 'Kernel/Controleur.php';
require_once 'Modele/User.php';
require_once 'Modele/School.php';
require_once 'Modele/Company.php';
require_once 'Modele/Post.php';

class ControleurWelcome extends Controleur {

    private $user;
    private $school;
    private $company;
    private $post;

    public function __construct()
    {
        $this->user = new User();
        $this->school = new School();
        $this->company = new Company();
        $this->post = new Post();
    }

    public function index()
    {
        $nbUsers = $this->user->getNumberUsers();
        $nbSchools = $this->school->getNumberSchools();
        $nbCompanies = $this->company->getNumberCompanies();
        $users = $this->user->lastUsersRegistered();
        $schools = $this->school->lastSchoolsRegistered();
        $companies = $this->company->lastCompaniesRegistered();
        $posts = $this->post->getLastPost();

        $this->generateVue(array('nbUsers' => $nbUsers, 'nbSchools' => $nbSchools, 'nbCompanies' => $nbCompanies, 
                                     'users' => $users, 'posts' => $posts, 'schools' => $schools, 'companies' => $companies));
    }

}