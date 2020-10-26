<?php

session_start();
 
require_once "connection.php";
 
if(isset($_POST['but_submit'])){

    $username = mysqli_real_escape_string($con,$_POST['username']);
    $password = mysqli_real_escape_string($con,$_POST['password']);

    if ($username != "" && $password != ""){

        $sql_query = "select count(*) as cntUser from tbluser where username='".$username."' and password='".$password."'";
        $result = mysqli_query($con,$sql_query);
        $row = mysqli_fetch_array($result);

        $count = $row['cntUser'];

        if($count > 0){
            $_SESSION['username'] = $username;
            echo '<script>alert("Successfully logged in.")</script>';
        }else{
            echo '<script>alert("Invalid username or password.")</script>';
        }

    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    
    <div class="container">
        <div class="card">
            <p id="pswrdInfo" class="text-white text-center"></p>
            <div class="card-header">
                <h3>Sign In</h3>
            </div>
            <div class="card-body">
                <form method="post" action="login.php">
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" class="form-control" placeholder="Username" name="username" id="username">
                    </div>
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        <input type="password" class="form-control" placeholder="Password" name="password" id="password">
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Login" class="btn float-right login_btn" name="but_submit" id="but_submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>

<style>
    html,body{
    background-image: url('bg.png');
    background-size: cover;
    background-repeat: no-repeat;
    height: 100%;
    }
    .container{
        display: flex;
        align-items: center;
        height: 100%;
        align-content: center;
    }

    .card{
        padding: 10px;
        height: 310px;
        margin: 0 auto;
        width: 400px;
        background-color: rgba(0,0,0,0.5);
    }

    .card-header h3{
        color: white;
    }

    .input-group-prepend span{
        width: 50px;
        background-color: rgb(245, 39, 217);
        color: black;
        border:0;
    }

    .form-group input[type=submit]{
        color: black;
        background-color: rgb(245, 39, 217);
        width: 100px;
    }

    .form-group:hover input[type=submit]{
        color: black;
        background-color: rgb(190, 31, 169);
    }

</style>