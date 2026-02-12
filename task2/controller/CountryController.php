<?php 
namespace CountryController;

require_once  __DIR__ ."/../models/country.php";

use CountryModel\Country;

class CountryController{
    public function Display(){
        $country = new Country();
        return $country -> displaycountry();
    }
}