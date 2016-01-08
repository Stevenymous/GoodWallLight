<?php

require_once 'Kernel/Controleur.php';
require_once 'Modele/Post.php';
require_once 'Modele/Comment.php';

class ControleurPost extends Controleur {

    private $post;
    private $comment;

    public function __construct()
    {
        $this->post = new Post();
        $this->comment = new Comment();
    }

    // Defalut action : show post
    public function index()
    {
        $postId = $this->request->getParameter("id");
        
        $post = $this->post->getPost($postId);
        $comments = $this->comment->getComment($postId);
        
        $this->generateVue(array('post' => $post, 'comments' => $comments));
    }

    // Add a comment to the post 
    public function commenter()
    {
        $postId = $this->request->getParameter("id");
        $author = $this->request->getParameter("author");
        $content = $this->request->getParameter("content");
        
        $this->comment->addComment($author, $content, $postId);
        
        $this->performAction("index"); //show post list
    }
}

