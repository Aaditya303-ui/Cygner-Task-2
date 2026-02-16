<?php 
session_start();
include_once '../task2/config/db.php';
use Database\Database;

$emailErr = "";
$passErr = "";
$message = "";

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $email = $_POST['email'];
    $password = $_POST['password'];

    if(empty($email) && empty($password)){
        $emailErr = "Email cant be empty";
        $passErr = "Password cant be empty";
    }elseif(empty($email)){
        $emailErr = "Email cant be empty";
    }elseif(empty($password)){
        $passErr = "Password cant be empty";
    }else{
         $db = new Database();
         $conn = $db -> connect();
        $stmt = $conn -> prepare("SELECT * FROM users WHERE email=:email");
        $data = [":email"=>$email];
        $stmt -> execute($data);

        $row = $stmt -> fetch(\PDO::FETCH_ASSOC);
        if($stmt -> rowCount() > 0){
            $db_password = $row['password'];

            if(password_verify($password,$db_password)){
                $_SESSION['email'] = $email;
                echo "
            <script>
                alert('Login Successfull');
                window.location.href = '/Task_2/task2/views/dashboard.php'
            </script>";
                exit();
            }else{
                $message = "Incorrect password";
            }
        }else{
            $message = "email not found";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assets/styles/login.css">
</head>
<body>
    <div class="container">
        <div class="form-box" id="login-form">
            <form action="" method="post">
                <h2>Login</h2>
                <span class="error msg"><?php echo $message; ?></span>
                <input name="email" type="email" placeholder="Enter Your Email">
                <span class="error msg"><?php echo $emailErr; ?></span>
                <input name="password" type="password" placeholder="Enter your password">
                <span class="error msg"><?php echo $passErr; ?></span>
                <button name="button" type="submit">Login</button>
                <p>Don't have account ? <a href="registration.php">Register</a></p>
            </form>
        </div>
    </div>
</body>
</html>