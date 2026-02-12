<?php
require_once '../../controller/CityController.php';

$q = intval($_GET['q']);

$cityController = new CityController\CityController();

$cities = $cityController -> Display($q);



echo "<label>Select City</label> <br>";
echo "<select name='city'>";
echo "<option value=''>Select the City</option>";
foreach($cities as $c){
    echo "<option value='".$c['id']."'>".$c['city_name']."</option>";
}
echo "</select>";  