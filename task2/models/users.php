<?php

namespace UserModel;

require_once __DIR__ . '/../config/db.php';

use Database\Database;

class User{
    private $conn;

    public function __construct(){
        $database = new Database();
        $this -> conn = $database -> connect();
    }

    public function createClient($data){
        $sql = "INSERT INTO clients 
                (fname,email,ph_num,img_path,pdf_path,coid,sid,cid) 
                VALUES
                (:fname,:email,:ph_num,:img_path,:pdf_path,:coid,:sid,:cid)";

        $stmt = $this -> conn -> prepare($sql);

        $query_execute = $stmt -> execute($data);
        if($query_execute){
            echo "
            <script>
                alert('Details added successfully');
                window.location.href = '/task_2/task2/views/users/display_users.php'
            </script>";
        }else{
            echo "
            <script>
                alert('Details didnt added');
                window.location.href = '/task_2/task2/views/users/display_users.php'
            </script>";
        }
    }

    public function displayAllUsers(){
        $sql = "SELECT * FROM clients";
        $stmt = $this -> conn -> prepare($sql);
        $stmt -> execute();
        return $stmt -> fetchAll(\PDO::FETCH_ASSOC);
    }

    public function displayUserById($id){
        $sql = "SELECT * FROM clients WHERE id=:id";
        $stmt = $this -> conn -> prepare($sql);
        $data = [":id" => $id];
        $stmt -> execute($data);
        return $stmt -> fetch(\PDO::FETCH_ASSOC);
    }

    public function delete($id){
        $sql = "DELETE FROM clients WHERE id=:id";
        $stmt = $this -> conn -> prepare($sql);
        $data = [":id" => $id];
        $stmt -> execute($data);
        $query_execute = $stmt -> execute($data);

        if($query_execute){
            return true;
        }
    }
    
    public function UpdateWithUpload($id, $data){
        $data[":id"] = $id;
        $fields = "
                fname = :fname, 
                email = :email,
                ph_num = :ph_num,
                coid = :coid, 
                sid = :sid, 
                cid = :cid 
        ";
        if(isset($data[':img_path'])){
             $fields .= ", img_path = :img_path";
        }
        if(isset($data[':pdf_path'])){
            $fields .= ", pdf_path = :pdf_path";
        }
          
        $sql = "UPDATE clients SET $fields WHERE id = :id";

        $stmt = $this -> conn -> prepare($sql);
        $query_execute = $stmt -> execute($data);

        if($query_execute){
            echo "
            <script>
                alert('Details added successfully');
                window.location.href = '/task_2/task2/views/users/display_users.php'
            </script>";
        }else{
            echo "
            <script>
                alert('Details didnt added');
                window.location.href = '/task_2/task2/views/users/display_users.php'
            </script>";
        }
    }
    }
