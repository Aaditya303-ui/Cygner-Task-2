<?php

namespace stateModel;

require_once __DIR__ .'/../config/db.php';

use Database\Database;

class State{
    private $conn;

    public function __construct(){
        $database = new Database();
        $this -> conn = $database -> connect();
    }

    public function displaystatebycid($cid){
        $sql = "SELECT * FROM states WHERE countryId = :countryId";
        $stmt = $this -> conn -> prepare($sql);
        $data = [":countryId"=>$cid];
        $stmt -> execute($data);
        return $stmt -> fetchAll(\PDO::FETCH_ASSOC);
    }
}