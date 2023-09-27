<?php

namespace App\model;

class UserModel extends GlobalModel{

    public function requestCheckEmail($email){
        $request = $this->connect->prepare("SELECT * FROM users WHERE email = :email");
        $request->execute([':email' => $email]);
        $data = $request->rowCount();
        return $data;
    }

    public function requestRegister($login, $email, $password){
        $request = $this->connect->prepare("INSERT INTO users (login, email, password) VALUES (:login, :email, :password)");
        $request->execute([':login' => $login,
                            ':email' => $email,
                            ':password' => $password
        ]);

        return $request;
    }

    public function requestGetDataMail($email){
        $request = $this->connect->prepare("SELECT * FROM users WHERE email = :email");
        $request->execute([':email' => $email]);

        $data = $request->fetch(\PDO::FETCH_ASSOC);
        return $data;
    }

    public function requestUpdate($id, $changes){

        $strRequest = "Update users SET";

        foreach ($changes as $key => $value) {
            $strRequest = $strRequest . " `$key` = :$key,";
        }

        $strRequest = rtrim($strRequest, ','); // suprimer la virgule finale
        $strRequest = $strRequest . " " . "WHERE id = $id";

        $request = $this->connect->prepare($strRequest);
        $request->execute($changes);
    }

}