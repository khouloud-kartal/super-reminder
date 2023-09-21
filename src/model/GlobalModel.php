<?php

namespace App\model;

class GlobalModel{

    protected $connect;

    public function __construct(){
        $this->connect = new \PDO('mysql:host=localhost;dbname=todolisttrello', 'root', 'root');
    }

    public function getConnect(){
        return $this->connect;
    }
}