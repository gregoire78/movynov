<?php

class DB
{
    private $_connection;
    private static $_instance; //The single instance
    private $_host = "db";
    private $_username = "root";
    private $_password = "root";
    private $_database = "movynov";

    /*
    Get an instance of the Database
    @return Instance
    */
    public static function getInstance()
    {
        if (!self::$_instance) { // If no instance then make one
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    // Constructor
    private function __construct()
    {
        try {
            $this->_connection = new PDO('mysql:dbname=' . $this->_database . ';host=' . $this->_host, $this->_username,
                $this->_password, [
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                ]);

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    // Magic method clone is empty to prevent duplication of connection
    private function __clone()
    {
    }

    // Get mysqli connection
    public function getConnection()
    {
        return $this->_connection;
    }


    function query($req, $data = [])
    {
        $stmt = $this->_connection->prepare($req);
        $stmt->execute($data);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    function exec($req, $data = [])
    {
        $stmt = $this->_connection->prepare($req);
        $stmt->execute($data);
    }

}