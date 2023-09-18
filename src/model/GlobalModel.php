<?php

namespace App\model;

class GlobalModel{

    protected $connect;

    public function __construct(){
        try {
            $this->connect = new \PDO('mysql:host=localhost;dbname=todolisttrello', 'root', '');

        } catch (PDOException $e) {
            var_dump($e->getMessage()) ;
        }

        return $this->connect;
    }

    public function getConnect(){
        return $this->connect;
    }
}