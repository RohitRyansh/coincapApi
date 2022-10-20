<?php
class db
{
    public $dbConn;
    function __construct()
    {
        $dbHost="mysql:host=localhost;dbname=coincap";  
        $dbUser="root";
        $dbPassword=""; 
        $this->dbConn= new PDO($dbHost,$dbUser,$dbPassword); 
    }
}

?>