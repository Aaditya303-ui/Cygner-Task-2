<?php

namespace CityModel;

require_once __DIR__ . '/../config/db.php';

use Database\Database;

class City{
    private $conn;

    public function __construct(){
        $database = new Database();
        $this -> conn = $database -> connect();
    }

    public function displaycitybysid($sid){
        $sql = "SELECT * FROM city WHERE State_id = :State_id";
        $stmt = $this -> conn -> prepare($sql);
        $data = [":State_id" => $sid];
        $stmt -> execute($data);
        return $stmt -> fetchAll(\PDO::FETCH_ASSOC);
    }
}