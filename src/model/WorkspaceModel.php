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
        $request = $this->connect->prepare("SELECT id, userId, title, description FROM workspace WHERE userId = :userId");
        $request->execute([':userId' => $userId]);
        $data = $request->fetchAll(\PDO::FETCH_ASSOC);
        return $data;
    }

    public function requestCheckTablesExists($userId, $workspaceId){
        $request = $this->connect->prepare("SELECT * FROM workspace INNER JOIN tables ON workspace.id = tables.workspaceId WHERE workspace.userId = :userId AND tables.workspaceId = :workspaceId");
        $request->execute([':userId' => $userId,
                            ':workspaceId' => $workspaceId
            ]);


        $data = $request->rowCount();

        if($data === 0){

            return false;
        }
        else{
            return true;
        }
    }


    public function requestDeleteWorkspace($workspaceId){
        $request = $this->connect->prepare("DELETE FROM workspace WHERE id = :workspaceId");
        $request->execute([':workspaceId' => $workspaceId]);
        return $request;
    }


}