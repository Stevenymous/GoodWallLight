<?php

require_once 'Session.php';

/**
 * HTTP request class
 */
class Request
{
    /** Array of request parameters */
    private $parameters;

    /** Session object */
    private $session;

    public function __construct($parameters)
    {
        $this->parameters = $parameters;
        $this->session = new Session();
    }

    public function getSession()
    {
        return $this->session;
    }

    
    public function getParameter($name)
    {
        if ($this->checkParameter($name))
        {
            return $this->parameters[$name];
        }
        else
        {
            throw new Exception("Parameter '$name' does not exist in this request");
        }
    }

    /**
     * @param string $name parameter's name
     * @return boolean true if parameter exist and his value is not empty
     */
    public function checkParameter($name)
    {
        return (isset($this->parameters[$name]) && $this->parameters[$name] != "");
    }

}