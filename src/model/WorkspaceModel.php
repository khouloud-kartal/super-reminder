<?php

namespace App\model;

class WorkspaceModel extends GlobalModel{

    public function requestAddWorkspace($title, $description, $userId){
        $request = $this->connect->prepare("INSERT INTO workspace (userId, title, description) VALUES (:userId, :title, :description)");
        $request->execute([':userId' => $userId,
                            ':title' => $title,
                            ':description' => $description
        ]);

        return $request;
    }

    public function requestGetWorkspaceByUserId($userId){
        $request = $this->connect->prepare("SELECT id, userId, title FROM workspace WHERE userId = :userId");
        $request->execute([':userId' => $userId]);
        $data = $request->fetchAll(\PDO::FETCH_ASSOC);
        return $data;
    }

}