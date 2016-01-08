<?php

require_once 'Kernel/Modele.php';

class Comment extends Modele {


    public function getComment($postId)
    {
        $sql = 'select com_id as id, com_date as date, com_author as author, com_content as content from comment'
                . ' where com_fk_post_id = ?';
        $comments = $this->executeQuery($sql, array($postId));
        return $comments;
    }

    public function addComment($author, $content, $postId, $currentUser)
    {
        $sql = 'insert into comment(com_date, com_author, com_content, com_fk_post_id, com_fk_per_id)'
                . ' values(?, ?, ?, ?, ?)';
        $date = date(DATE_W3C);
        $this->executeQuery($sql, array($date, $author, $content, $postId, $currentUser));
    }
    
    public function getNumberComment()
    {
        $sql = 'select count(*) as nbComments from comment';
        $result = $this->executeQuery($sql);
        $row = $result->fetch();
        return $row['nbComments'];
    }
}