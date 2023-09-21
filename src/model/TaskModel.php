<?php

namespace App\model;

class TaskModel extends GlobalModel{

    public function requestAddTask($title, $description, $color, $listId){
        $request = $this->connect->prepare("INSERT INTO tasks (listId, title, description, color) VALUES (:listId, :title, :description, :color)");
        $request->execute([':listId' => $listId,
                            ':title' => $title,
                            ':description' => $description,
                            ':color' => $color
        ]);

        return $request;
    }

    public function requestGetTasksByListIdId($listId){
        $request = $this->connect->prepare("SELECT * FROM tasks WHERE listId = :listId ORDER BY id ASC");
        $request->execute([':listId' => $listId]);
        $data = $request->fetchAll(\PDO::FETCH_ASSOC);
        return $data;
    }

}