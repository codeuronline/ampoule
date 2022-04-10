<?php
abstract class Database
{
    protected $host = "localhost";
    protected $dbname = "immeuble";
    protected $user = "root";
    protected $pwd = "";

    public function getPDO()
    {
        $db = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->pwd);
        
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES utf8');
        return $db;
    }
    
    

    public function hydrate(array $element)
    {
    }
}