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

}