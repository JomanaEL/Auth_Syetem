<?php
// enableing error display
error_reporting(-1);
ini_set('display_errors', 'On');
// starting the session
session_start();
//Database Configuration File
include('dbconn.php');
// Checking if you have a user in your session
 if(isset($_SESSION['user_login']))
  {
header("Location: home.php");
 exit;
  }
// Logging in
 if(isset($_POST['login']))
  {
// Fetching email
    $email=$_POST['email'];
    $password=md5($_POST['password']);
// Fetch data from database on the basis of email and password
    $sql ="SELECT email,password,id FROM userdata WHERE email=:email";
    $query= $conn -> prepare($sql);
    $query-> bindParam(':email', $email, PDO::PARAM_STR);
    $query-> execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
// fetching password
    $check = $results[0]->password;
    $user_id = $results[0]->id;
// comparing the input password with the one in database
 if ($password == $check) {

     $_SESSION["user_id"] = $user_id;
     $_SESSION['user_login']=$_POST['email'];
       echo "<script type='text/javascript'> document.location = 'home.php'; </script>";
    }
 else {echo "<script>alert('Invalid Details');</script>";}
    }
?>
<!DOCTYPE html>
<html lang="en">
 <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="CSS/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
 </head>
 <body>

     <section class="container_fluid">
       <section class="row justify-content-center">
         <section class="col-12 col-sm-6 col-md-3">
            <form class="form_controler" id="loginForm" method="post">
<div class="container pt-2 pb-2 my-2 rounded bg-primary text-white text-center"><h3>Login Form</h3></div>
   <div class="form-group">
   <input type="text" class="form-control"  name="email" placeholder="E-mail" required>
    </div>

   <div class="form-group">
   <input type="password" class="form-control"  name="password" placeholder="Password"  required>
   </div>

   <button type="submit" class="btn btn-outline-primary btn-block" name="login">Login</button>
    Not a member? <a href="register.php">Sign up</a>
</form>
</section>
</section>
</section>
</body>
</html>
