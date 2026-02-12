<?php 

namespace countryModel;

require_once __DIR__ .'/../config/db.php';

use Database\Database;

class Country{
    private $conn;

    public function __construct(){
        $database = new Database();
        $this -> conn = $database -> connect();
    }

    public function displaycountry(){
        $sql = "SELECT * FROM country";
        $stmt = $this -> conn -> prepare($sql);
        $stmt -> execute();
        return $stmt -> fetchAll(\PDO::FETCH_ASSOC);
    }

    public function displaycountrybyid($id){
        $sql = "SELECT * FROM country WHERE id = :id";
        $stmt = $this -> conn -> prepare($sql);
        $data = [":id"=>$id];
        $stmt -> execute($data);
        return $stmt -> fetch(\PDO::FETCH_ASSOC);
    }
}