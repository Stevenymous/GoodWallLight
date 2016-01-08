<?php

require_once 'ControleurSecure.php';
require_once 'Modele/User.php';
require_once 'Modele/Company.php';
require_once 'Modele/School.php';
require_once 'Modele/Post.php';
require_once 'Modele/Comment.php';

class ControleurProfile extends ControleurSecure
{
    private $user;
    private $company;
    private $school;
    private $post;
    private $comment;

    public function __construct()
    {
        $this->user = new User();
        $this->company = new Company();
        $this->school = new School();
        $this->post = new Post();
        $this->comment = new Comment();
    }

    public function index()
    {
        $userId = $this->request->getSession()->getAttribute("userId");
        $nbPosts = $this->post->getNumberPosts();
        $nbComments = $this->comment->getNumberComment();
        $userPosts = $this->post->getUserPosts($userId);
        $companiesCreated = $this->company->getCompanyByHisCreator($userId);
        $schoolsCreated = $this->school->getSchoolByHisCreator($userId);

        $profile = $this->user->getUserProfile($userId);
        $profile['birthDate'] = substr($profile['birthDate'], 0, 10);

        if($profile['gender'] == 1)
        {
            $profile['gender'] = "Male";
        }
        else
        {
            $profile['gender'] = "Female";
        }

        $this->generateVue(array('nbPosts' => $nbPosts, 'nbComments' => $nbComments, 'profile' => $profile, 'userPosts' => $userPosts, 'companiesCreated' => $companiesCreated, 'schoolsCreated' => $schoolsCreated ));
    }

    public function schoolForm()
    {
        $userId = $this->request->getSession()->getAttribute("userId");
        $currentUser = $this->user->getUserProfile($userId);

        $this->generateVue(array('currentUser' => $currentUser));
    }
 
    public function school()
    {
        $name = $this->request->getParameter("name");
        $creationDate = $this->request->getParameter("creationDate");
        $location = $this->request->getParameter("location");
        $studentsNumber = $this->request->getParameter("studentsNumber");
        $teachersNumber = $this->request->getParameter("teachersNumber");
        $about = $this->request->getParameter("about");
        $currentUser = $this->request->getSession()->getAttribute("userId");
        
        $this->school->addSchool($name, $creationDate, $location, $studentsNumber, $teachersNumber, $about, $currentUser);

        $this->redirect("profile");
    }

    public function schoolProfile()
    {
        $schoolId = $this->request->getParameter("id");
        
        $school = $this->school->getSchool($schoolId);
        $school['creationDate'] = substr($school['creationDate'], 0, 10);
        
        $this->generateVue(array('school' => $school), 'schoolProfile');
    }

    public function companyForm()
    {
        $this->generateVue();
    }
 
    public function company()
    {
        $name = $this->request->getParameter("name");
        $companyOwner = $this->request->getParameter("companyOwner");
        $creationDate = $this->request->getParameter("creationDate");
        $location = $this->request->getParameter("location");
        $industrySector = $this->request->getParameter("industrySector");
        $about = $this->request->getParameter("about");
        $userId = $this->request->getSession()->getAttribute("userId");
        
        $this->company->addCompany($name, $companyOwner, $creationDate, $location, $industrySector, $about, $userId);

        $this->redirect("profile");
    }

    public function companyProfile()
    {
        $companyId = $this->request->getParameter("id");
        
        $company = $this->company->getCompany($companyId);
        $company['creationDate'] = substr($company['creationDate'], 0, 10);
        
        $this->generateVue(array('company' => $company), 'companyProfile');
    }

}

