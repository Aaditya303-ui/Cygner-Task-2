<?php 
include '../../includes/navbar.php'; 
include_once '../../controller/userController.php';

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Users</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" 
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
    crossorigin="anonymous">
</head>
<style>
    .img{
        height: 100px;
        width: 100px;
        border-radius: 50%;
    }
</style>
<body>
    <table class="table">
        <thead>
            <tr>
                <th>id</th>
                <th>Image</th>
                <th>Name</th>
                <th>email</th>
                <th>phone Number</th>
                <th>Update</th>
                <th>Delete</th>
                <th><a class="btn btn-warning" href='add_user.php'>+</a></th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $userController = new UserController\UserController();
            $users = $userController -> displayAll();
            ?>
            <?php if(isset($users)): ?>
                <?php foreach($users as $u): ?>
            <tr>
                <td class="row"><?php echo $u['id']; ?></td>
                <td><img class="img" src="../../assets/image/<?php echo $u['img_path']; ?>" alt=""></td>
                <td><?php echo $u['fname']; ?></td>
                <td><?php echo $u['email']; ?></td>
                <td><?php echo $u['ph_num']; ?></td>
                <td><a type="button" href='add_user.php' class="btn btn-warning">update</a></td>
                <td><a type="button" class="btn btn-danger">delete</a></td>
            </tr>
            <?php endforeach?>
            <?php endif?>
        </tbody>
    </table>
</body>
</html>