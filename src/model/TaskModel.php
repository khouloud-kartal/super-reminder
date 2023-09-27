<?php

namespace App\model;

class TaskModel extends GlobalModel{

    public function requestAddTask($title, $description, $color, $finDate, $tag, $listId){
        $request = $this->connect->prepare("INSERT INTO tasks (listId, title, description, color, finDate, tag) VALUES (:listId, :title, :description, :color, :finDate, :tag)");
        $request->execute([':listId' => $listId,
                            ':title' => $title,
                            ':description' => $description,
                            ':color' => $color,
                            ':finDate' => $finDate,
                            ':tag' => $tag
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

    public function requestCheckTag($name){
        $request = $this->connect->prepare("SELECT * FROM tags WHERE name = :name");
        $request->execute([':name' => $name]);
        $data = $request->rowCount();
        return $data;
    }

    public function requestDeleteTask($taskId){
        $request = $this->connect->prepare("DELETE FROM tasks WHERE id = :taskId");
        $request->execute([':taskId' => $taskId]);
        return $request;
    }

    public function requestAddTags($name, $emoji, $userId){
        $request = $this->connect->prepare("INSERT INTO tags (userId, name, emoji) VALUES (:userId, :name, :emoji)");
        $request->execute([':userId' => $userId,
                            ':name' => $name,
                            ':emoji' => $emoji
        ]);

        return $request;
    }

    public function requestGetTagsByUserId($userId){
        $request = $this->connect->prepare("SELECT * FROM tags WHERE userId = :userId ORDER BY id DESC");
        $request->execute([':userId' => $userId]);
        $data = $request->fetchAll(\PDO::FETCH_ASSOC);
        return $data;
    }

}