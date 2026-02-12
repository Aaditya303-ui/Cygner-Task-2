<?php 
namespace CityController;

require_once  __DIR__ ."/../models/city.php";

use CityModel\City;

class CityController{
    public function Display($sid){
        $city = new City();
        return $city -> displaycitybysid($sid);
    }
}