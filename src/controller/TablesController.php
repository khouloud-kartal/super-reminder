<?php

namespace App\controller;
use App\model\TablesModel;

class TablesController{
    private ?int $id;

    private ?int $workspaceId;

    private ?string $title;

    private ?string $description;

    public ?string $msg;

    public function __construct(){

    }

    private function checkFormNotEmpty($posts){

        foreach ($posts as $post) {
            if ($post == null || $post == '') {
                return false;
            }
        }
        return true;

    }
    public function addTable($post){
        if($this->checkFormNotEmpty($post)){
            $request = new TablesModel();
            $request->requestAddTables($post['title'], $post['description'], $post['workspace']);
            $this->msg = '<p>Table is added</p>';
        }else{
            $this->msg = '<p>remplir tous les champs</p>';
        }

    }

    public function GetTablesByWorkspaceId($workspaceId){
        $request = new TablesModel();
        $data = $request->requestGetTablesByWorkspaceId($workspaceId);
        return $data;
    }

    ##################################################################################
    ######################################## Getters #################################
    ##################################################################################


    public function getId(){
        return $this->id;
    }

    public function getWorkspaceId(){
        return $this->workspaceId;
    }
    public function getTitle()
    {
        return $this->title;
    }

    public function getDescription(){
        return $this->description;
    }

    public function getMsg(){
        return $this->msg;
    }

    ##################################################################################
    ######################################## Setters #################################
    ##################################################################################


    public function setId($id){
        $this->id = $id;
    }

    public function setWorkspaceId($workspaceId){
        $this->id = $workspaceId;
    }

    public function setTitle($title){
        $this->title = $title;
    }

    public function setDescription($description){
        $this->description = $description;
    }


}