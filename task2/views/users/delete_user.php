<?php 

require_once __DIR__ . '/../../controller/userController.php';

$userController = new userController\userController();

$id = $_GET['q'];

if($userController -> delete($id)){
    echo "<script>
        alert('Client Data deleted successfully!'); 
         window.location.href='/task_2/task2/views/users/display_users.php';
        </script>";
}

