<?php 
include_once '../task2/config/db.php';
use Database\Database;

$message = "";
$nameErr = "";
$emailErr = "";
$passErr = "";

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if(empty($name)){
        $nameErr = "Name is required";
    }elseif(empty($email)){
        $emailErr = "Email is required";
    }elseif(empty($password)){
        $passErr = "Password is required";
    }else{
        $db = new Database();
        $conn = $db->connect();

        $stmt = $conn -> prepare("SELECT id FROM users WHERE email = :email");
        $stmt -> execute([":email"=> $email]);

        if($stmt->rowCount()>0){
            $message = "Already Taken";
        }else{
            $hashedPassword = password_hash($password,PASSWORD_DEFAULT);
              $insert = $conn->prepare(
            "INSERT INTO users (name,email,password) VALUES (:name,:email,:password)"
        );

        $insert->execute([
            ":name" => $name,
            ":email" => $email,
            ":password" => $hashedPassword
        ]);
        header("Location: login.php");
        exit();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="assets/styles/login.css">
</head>
<body>
    <div class="container">
        <div class="form-box" id="login-form">
            <form action="registration.php" method="post">
                <h2>Registration</h2>
                <span class="error msg"><?php echo $message; ?></span>
                <input name="name" type="text" placeholder="Enter Your Name">
                <span class="error"><?php echo $nameErr; ?></span>
                <input name="email" type="email" placeholder="Enter Your Email">
                <span class="error"><?php echo $emailErr; ?></span>
                <input name="password" type="password" type="password" placeholder="Enter your password">
                <span class="error"><?php echo $passErr; ?></span>
                <button name="button" type="submit">Register</button>
                <p>Already have account ? <a href="login.php">SignUp</a></p>
            </form>
        </div>
    </div>
</body>
</html>