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
}