<?php

require_once 'Kernel/Modele.php';

class Company extends Modele {


    public function addCompany($name, $companyOwner, $creationDate, $location, $industrySector, $about, $personCreator)
    {
       $sql = 'insert into company(cny_name, cny_company_owner, cny_creation_date, cny_location, cny_industry_sector, cny_about, cny_fk_per_id)'
                . ' values(?, ?, ?, ?, ?, ?, ?)';
        $this->executeQuery($sql, array($name, $companyOwner, $creationDate, $location, $industrySector, $about, $personCreator));
    }

    /**
     * Return informations about one company by her creator id for user profile
     */
    public function getCompanyByHisCreator($creatorId)
    {
        $sql = 'select cny_id as id, cny_fk_per_id as creatorId, cny_name as name, cny_industry_sector as industrySector'
                .   ' from company'
                .   ' where cny_fk_per_id = ?';
        $company = $this->executeQuery($sql, array($creatorId));
        return $company;
    }

    /**
     * Return all informations about one company
     */
    public function getCompany($companyId)
    {
        $sql = 'select cny_id as id, cny_location as location, cny_name as name, cny_industry_sector as industrySector, cny_creation_date as creationDate, cny_about as about, cny_company_owner as companyOwner'
                .   ' from company'
                .   ' where cny_id = ?';
        $company = $this->executeQuery($sql, array($companyId));
        if ($company->rowCount() > 0)
            return $company->fetch();
        else
            throw new Exception("No Company matches the id : '$companyId'");
    }
    
    public function getNumberCompanies()
    {
        $sql = 'select count(*) as nbCompanies from company';
        $result = $this->executeQuery($sql);
        $row = $result->fetch();
        return $row['nbCompanies'];
    }

    public function lastCompaniesRegistered()
    {
        $sql = 'select cny_id as companyId, cny_name as name, cny_industry_sector as industrySector'
                . ' from company'
                . ' order by cny_id desc limit 2';
        $user = $this->executeQuery($sql);
        return $user;
    }

}