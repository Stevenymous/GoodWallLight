<?php

require_once 'Configuration.php';

/**
 * Use PHP PDO API
 */
abstract class Modele
{
    /** PDO object */
    private static $bdd;

    /**
     * Create connection and return connection PDO object
     */
    private static function getDatabase()
    {
        if (self::$bdd === null)
        {
            $dsn = Configuration::get("dsn");
            $login = Configuration::get("login");
            $mdp = Configuration::get("mdp");
            self::$bdd = new PDO($dsn, $login, $mdp,
                    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        }
        return self::$bdd;
    }
    
    /**
     * Execute direct or prepared statement
     */
    protected function executeQuery($sql, $params = null)
    {
        try
        {
            if ($params == null)
            {
                $resultat = self::getDatabase()->query($sql);
            }
            else
            {
                $resultat = self::getDatabase()->prepare($sql);
                $resultat->execute($params);
            }
            return $resultat;
        } catch (Exception $e) {
         die('Error : '.$e->getMessage());
        }
    }

}
