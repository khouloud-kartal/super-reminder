<?php

namespace App\model;

class TablesModel extends GlobalModel{

    public function requestAddTables($title, $description, $workspaceId){
        $request = $this->connect->prepare("INSERT INTO tables (workspaceId, title, description) VALUES (:workspaceId, :title, :description)");
        $request->execute([':workspaceId' => $workspaceId,
                            ':title' => $title,
                            ':description' => $description
        ]);

        return $request;
    }

}