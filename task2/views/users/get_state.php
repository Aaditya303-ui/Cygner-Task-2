<?php 
require_once '../../controller/StateController.php';

$q = intval($_GET['q']);

$stateController = new StateController\StateController();

$states = $stateController -> Display($q);



echo "<label>Select State</label> <br>";
echo "<select name='state' onchange='showCity(this.value)'>";
echo "<option value=''>Select the State</option>";
foreach($states as $s){
    echo "<option value='".$s['State_id']."'>".$s['name']."</option>";
}
echo "</select>";  