<?php include '../../includes/navbar.php'; ?>

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
<body>
    <table class="table">
        <thead>
            <tr>
                <th>id</th>
                <th>Image</th>
                <th>Name</th>
                <th>email</th>
                <th>phone Number</th>
                <th>view Profile</th>
                <th><a class="btn btn-warning" href='add_user.php'>+</a></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="row">1</td>
                <td>image</td>
                <td>mark otto</td>
                <td>mark@gmail.com</td>
                <td>+91 878689978</td>
                <td><a type="button" class="btn btn-success">View</a></td>
            </tr>
        </tbody>
    </table>
</body>
</html>