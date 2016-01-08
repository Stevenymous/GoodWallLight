<?php

/**
 * Configuration settings management class
 */
class Configuration
{
    /** Array of configuration parameters */
    private static $parameters;

    /**
     * Return parameter value
     * 
     * @param string $name parameter's name
     * @param string $defaultValue default return value
     * @return string $value parameter's value
     */
    public static function get($name, $defaultValue = null)
    {
        $parameters = self::getParameters();
        if (isset($parameters[$name]))
        {
            $value = $parameters[$name];
        }
        else
        {
            $value = $defaultValue;
        }
        return $value;
    }

    /**
     * Search into configuration files and return parameters values 
     * Configuration files : Config/dev.ini et Config/prod.ini
     * 
     * @return $parameters array of configuration parameters
     * @throws Exception if no configuration file is found
     */
    private static function getParameters()
    {
        if (self::$parameters == null)
        {
            $filePath = "Configuration/dev.ini";
            if (!file_exists($filePath))
            {
                $filePath = "Configuration/prod.ini";
            }
            if (!file_exists($filePath))
            {
                throw new Exception("No configuration file found");
            }
            else
            {
                self::$parameters = parse_ini_file($filePath);
            }
        }
        return self::$parameters;
    }

}