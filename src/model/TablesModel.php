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

    public function requestGetTablesByWorkspaceId($workspaceId){
        $request = $this->connect->prepare("SELECT * FROM tables WHERE workspaceId = :workspaceId ORDER BY id ASC");
        $request->execute([':workspaceId' => $workspaceId]);
        $data = $request->fetchAll(\PDO::FETCH_ASSOC);
        return $data;
    }

    public function requestDeleteList($listId){
        $request = $this->connect->prepare("DELETE FROM tables WHERE id = :listId");
        $request->execute([':listId' => $listId]);
        return $request;
    }

    public function requestCheckListId($userId, $listId){

        $request = $this->connect->prepare("SELECT * FROM tables INNER JOIN workspace ON tables.workspaceId = workspace.id WHERE userId = :userId AND tables.id = :listId");

        $request->execute([':userId' => $userId,
                            ':listId' => $listId
            ]);

    
        $data = $request->rowCount();
        if($data === 0){

            return false;
        }
        else{
            return true;
        }
    }

}