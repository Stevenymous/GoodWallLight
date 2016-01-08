<?php

require_once 'Kernel/Modele.php';

class User extends Modele {

    /**
     * Check if user exist into database
     * Return true if user exist, false otherwise
     */
    public function checkUserExist($email)
    {
        $sql = "select per_id from person where per_email=?";
        $user = $this->executeQuery($sql, array($email));
        return ($user->rowCount() == 1);
    }

    public function addUser($firstName, $lastName, $birthDate, $sex, $location, $about, $email, $password)
    {
       $sql = 'insert into person(per_first_name, per_last_name, per_birth_date, per_gender, per_location, per_about, per_email, per_password)'
                . ' values(?, ?, ?, ?, ?, ?, ?, ?)';
        $this->executeQuery($sql, array($firstName, $lastName, $birthDate, $sex, $location, $about, $email, $password));
    }

    public function getUser($email, $password)
    {
        $sql = 'select per_id as userId, per_email as email, per_password as password'
                . ' from person'
                . ' where per_email=? and per_password=?';
        $user = $this->executeQuery($sql, array($email, $password));
        if ($user->rowCount() == 1)
            return $user->fetch();
        else
            throw new Exception("No user match with email or password provided.");
    }

    /**
     * Return all profile informations about one user
     */
    public function getUserProfile($userId)
    {
        $sql = 'select per_id as userId, per_last_name as lastName, per_first_name as firstName, per_birth_date as birthDate, per_gender as gender, per_location as location, per_about as about'
                .   ' from person'
                .   ' where per_id = ?';
        $profile = $this->executeQuery($sql, array($userId));
        if ($profile->rowCount() > 0)
            return $profile->fetch();
        else
            throw new Exception("Your profile is not completed.");
    }

    public function lastUsersRegistered()
    {
        $sql = 'select per_id as userId, per_last_name as lastName, per_first_name as firstName, per_location as location, per_about as about'
                . ' from person'
                . ' order by per_id desc limit 2';
        $user = $this->executeQuery($sql);
        return $user;
    }

    public function getNumberUsers()
    {
        $sql = 'select count(*) as nbUsers from person';
        $result = $this->executeQuery($sql);
        $row = $result->fetch();
        return $row['nbUsers'];
    }

}