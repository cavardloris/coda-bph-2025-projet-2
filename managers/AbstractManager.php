<?php

abstract class AbstractManager
{
    private PDO $db;

    public function __construct()
    {
        $host = "localhost";
        $port = "3306";
        $dbname = "projet-the-league";
        $connexionString = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8";

        $user = "root";
        $password = "";

        $this->db = new PDO(
            $connexionString,
            $user,
            $password
        );
    }
}