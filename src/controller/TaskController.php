<?php

namespace App\controller;
use App\model\TablesModel;
use App\model\TaskModel;

class TaskController{
    private ?int $id;

    private ?int $listId;

    private ?string $title;

    private ?string $description;

    private ?string $state;

    private ?string $color;

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
    public function addTask($post, $listId){
        if($this->checkFormNotEmpty($post)){
            $request = new TaskModel();
            $request->requestAddTask($post['title'], $post['description'], $post['color'], $listId);
            $this->msg = '<p>Task is added</p>';
        }else{
            $this->msg = '<p>remplir tous les champs</p>';
        }

    }

    public function getAllTasksJson($listId){
        $request = new TaskModel();
        $data = $request->requestGetTasksByListIdId($listId);
        $json = json_encode($data, JSON_PRETTY_PRINT);

        return $json;
    }

    

    ##################################################################################
    ######################################## Getters #################################
    ##################################################################################


    public function getId(){
        return $this->id;
    }

    public function getWorkspaceId(){
        return $this->listId;
    }
    public function getTitle()
    {
        return $this->title;
    }

    public function getDescription(){
        return $this->description;
    }

    public function getState(){
        return $this->state;
    }

    public function getColor(){
        return $this->color;
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

    public function setState($state){
        $this->state = $state;
    }

    public function setColor($color){
        $this->color = $color;
    }


}