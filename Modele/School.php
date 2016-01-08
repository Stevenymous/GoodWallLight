<?php

require_once 'Kernel/Modele.php';

class School extends Modele {


    public function addSchool($name, $creationDate, $location, $studentsNumber, $teachersNumber, $about, $currentUser)
    {
       $sql = 'insert into school(scl_name, scl_creation_date, scl_location, scl_students_number, scl_teachers_number, scl_about, scl_director_fk_per_id)'
                . ' values(?, ?, ?, ?, ?, ?, ?)';
        $this->executeQuery($sql, array($name, $creationDate, $location, $studentsNumber, $teachersNumber, $about, $currentUser));
    }

    /**
     * Return all informations about one school
     */
    public function getSchool($creatorId)
    {
        $sql = 'select scl_id as id, scl_location as location, scl_name as name, scl_students_number as studentsNumber, scl_teachers_number as teachersNumber, scl_creation_date as creationDate, scl_about as about'
                .   ' from school'
                .   ' where scl_id = ?';
        $school = $this->executeQuery($sql, array($creatorId));
        if ($school->rowCount() >= 0)
            return $school->fetch();
        else
            throw new Exception("No School matches the id : '$creatorId'");
    }

    /**
     * Return all informations about one school by her creator id for user profile
     */
    public function getSchoolByHisCreator($creatorId)
    {
        $sql = 'select scl_id as id, scl_location as location, scl_name as name'
                .   ' from school'
                .   ' where scl_director_fk_per_id = ?';
        $school = $this->executeQuery($sql, array($creatorId));
        return $school;
    }

    public function getNumberSchools()
    {
        $sql = 'select count(*) as nbSchools from school';
        $result = $this->executeQuery($sql);
        $row = $result->fetch();
        return $row['nbSchools'];
    }

    public function lastSchoolsRegistered()
    {
        $sql = 'select scl_id as schoolId, scl_name as name, scl_about as about'
                . ' from school'
                . ' order by scl_id desc limit 2';
        $user = $this->executeQuery($sql);
        return $user;
    }

}