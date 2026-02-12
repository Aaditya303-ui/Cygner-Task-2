<?php 
namespace StateController;

require_once  __DIR__ ."/../models/state.php";

use StateModel\State;

class StateController{
    public function Display($cid){
        $state = new State();
        return $state -> displaystatebycid($cid);
    }
}