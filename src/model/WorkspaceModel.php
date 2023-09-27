<?php

namespace App\model;

use App\model\UserModel;

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
        $request = $this->connect->prepare("SELECT DISTINCT workspace.id, workspace.title, workspace.description
                                            FROM workspace
                                            LEFT JOIN userworkspace ON workspace.id = userworkspace.workspaceId
                                            WHERE userworkspace.userId = :userId OR workspace.userId = :userId");
        $request->execute([':userId' => $userId]);
        $data = $request->fetchAll(\PDO::FETCH_ASSOC);
        return $data;
    }

    public function requestCheckWorkspaceExists($userId, $workspaceId){

        $request = $this->connect->prepare("SELECT DISTINCT workspace.id, workspace.title, workspace.description
                                            FROM workspace
                                            LEFT JOIN userworkspace ON workspace.id = userworkspace.workspaceId
                                            WHERE userworkspace.userId = :userId OR workspace.userId = :userId");

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


    public function requestCheckUserExists($userEmail){

        $request = $this->connect->prepare("SELECT users.id, users.email FROM users WHERE email = :userEmail");
        $request->execute([':userEmail' => $userEmail]);
        $data = $request->fetchAll(\PDO::FETCH_ASSOC);
        return $data;

    }

    public function requestAddUserToWorkspace($workspaceId, $userId){

        $request = $this->connect->prepare("INSERT INTO userworkspace (workspaceId, userId) VALUES (:workspaceId, :userId)");
        $request->execute([':workspaceId' => $workspaceId, 
                            ':userId' => $userId]);

        return $request;   
        
    }

    public function requestGetMembersByWorkspace($workspaceId){
        $request = $this->connect->prepare("SELECT DISTINCT users.id, users.login, users.email
                                            FROM users
                                            LEFT JOIN userworkspace ON users.id = userworkspace.userId
                                            LEFT JOIN workspace ON userworkspace.workspaceId = workspace.id
                                            WHERE userworkspace.workspaceId = :workspaceId OR workspace.id = :workspaceId");
        $request->execute([':workspaceId' => $workspaceId]);
        $data = $request->fetchAll(\PDO::FETCH_ASSOC);
        return $data;
    }

}