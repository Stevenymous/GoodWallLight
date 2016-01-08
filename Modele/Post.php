<?php

require_once 'Kernel/Modele.php';

class Post extends Modele {

    /**
     * Return all posts
     */
    public function getPosts()
    {
        $sql = 'select post_id as id, post_date as date, post_title as title, post_content as content'
                . ' from post'
                . ' order by post_id desc';
        $posts = $this->executeQuery($sql);
        return $posts;
    }

    /**
     * Return post detail
     */
    public function getPost($postId)
    {
        $sql = 'select post_id as id, post_date as date, post_title as title, post_content as content'
                . ' from post'
                . ' where post_id = ?';
        $post = $this->executeQuery($sql, array($postId));
        if ($post->rowCount() > 0)
            return $post->fetch();
        else
            throw new Exception("No ticket matches the id : '$postId'");
    }

    public function getLastPost()
    {
        $sql = 'select post_id as id, post_date as date, post_title as title, post_content as content, per_last_name as lastName, per_first_name as firstName'
                . ' from post, person'
                . ' where post_fk_per_id = per_id'
                . ' order by post_id desc limit 1';
        $post = $this->executeQuery($sql);
        return $post;
    }
    
    public function getUserPosts($userId)
    {
        $sql = 'select post_id as id, post_date as date, post_title as title, post_content as content'
                . ' from post'
                . ' where post_fk_per_id = ?';
        $post = $this->executeQuery($sql, array($userId));
        return $post;
    }

    public function getNumberPosts()
    {
        $sql = 'select count(*) as nbPosts from post';
        $result = $this->executeQuery($sql);
        $row = $result->fetch();
        return $row['nbPosts'];
    }
}