<?php

class Session
{

    public function __construct()
    {
        session_start();
    }

    public function destroy()
    {
        session_destroy();
    }

    public function getAttribute($name)
    {
        if ($this->checkAttributeExist($name))
        {
            return $_SESSION[$name];
        }
        else
        {
            throw new Exception("Field '$name' is not found on this session");
        }
    }

    public function setAttribute($name, $value)
    {
        $_SESSION[$name] = $value;
    }

    /**
     * Return true if attribut exist and his value is not empty
     */
    public function checkAttributeExist($name)
    {
        return (isset($_SESSION[$name]) && $_SESSION[$name] != "");
    }

}