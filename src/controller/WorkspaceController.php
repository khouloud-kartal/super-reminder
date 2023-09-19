<?php

namespace App\controller;
use App\model\WorkspaceModel;

class WorkspaceController{
    private ?int $id;

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
    public function addWorkspace($post, $userId){
        if($this->checkFormNotEmpty($post)){
            $request = new WorkspaceModel();
            $request->requestAddWorkspace($post['title'], $post['description'], $userId);
            $this->msg = '<p>Work Space is added</p>';
        }else{
            $this->msg = '<p>remplir tous les champs</p>';
        }

    }

    ##################################################################################
    ######################################## Getters #################################
    ##################################################################################


    public function getId(){
        return $this->id;
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

    public function setTitle($title){
        $this->title = $title;
    }

    public function setDescription($description){
        $this->description = $description;
    }


}