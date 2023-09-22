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
        $request = $this->connect->prepare("SELECT * FROM tasks WHERE listId = :listId ORDER BY id DESC");
        $request->execute([':listId' => $listId]);
        $data = $request->fetchAll(\PDO::FETCH_ASSOC);
        return $data;
    }

    public function requestUpdateState($taskId, $state){
        $request = $this->connect->prepare("UPDATE tasks SET state = :state WHERE id = :taskId ");
        $request->execute([':taskId' => $taskId,
                            ':state' => $state
        ]);
        return $request;
    }

    public function requestCheckTask($title){
        $request = $this->connect->prepare("SELECT * FROM tasks WHERE title = :title");
        $request->execute([':title' => $title]);
        $data = $request->rowCount();
        return $data;
    }

    public function requestDeleteTask($taskId){
        $request = $this->connect->prepare("DELETE FROM tasks WHERE id = :taskId");
        $request->execute([':taskId' => $taskId]);
        return $request;
    }


}