<?php

namespace App\model;

class GlobalModel{
    protected $connect;

    public function __construct(){
        $this->connect = new \PDO('mysql:host=localhost;dbname=todolisttrello', 'root', '', array(\PDO::MYSQL_ATTR_INT_COMMAND=>'SET NAMES utf8'));
    }

    public function getConnect(){
        return $this->connect;
    }
}