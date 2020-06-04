<?php

//**************************  Name | Jomana Elghali
//**************************  Start Date | The 1st of february, Saterday
//**************************  Signup/Signin System!

//Database Configuration File
include('dbconn.php');
error_reporting(0);

if(isset($_POST['signup']))
 {
  // Getting Post Values
  $firstname=$_POST['firstname'];
  $lastname=$_POST['lastname'];
  $email=$_POST['email'];
  $password=md5($_POST['password']);
  $password_conf =md5($_POST['password_conf']);
  $type=$_POST['usertype'];

  // Fetch data from database on the basis of email
   $sql ="SELECT email FROM userdata WHERE email='$email'";
   $query= $conn -> prepare($sql);
   $query-> execute();
   $results=$query->fetchAll(PDO::FETCH_OBJ);
   $check = $results[0]->email;

   // Validation
if($email == $check || $password != $password_conf)
 {
   echo "<script>alert('Either Email-id Already Exists Or Passwords Do Not Match.');</script>";
 }

// Query for Insertion
else {
  $sql="INSERT INTO userdata (first_name,last_name,email,password,password_conf,type) VALUES ('$firstname','$lastname','$email','$password','$password_conf','$type')";
  $query = $conn->prepare($sql);

// Binding Post Values
  $query->bindParam(':firstname',$firstname,PDO::PARAM_STR);
  $query->bindParam(':lastname',$lastname,PDO::PARAM_STR);
  $query->bindParam(':email',$email,PDO::PARAM_STR);
  $query->bindParam(':password',$password,PDO::PARAM_STR);
  $query->bindParam(':password_conf',$password_conf,PDO::PARAM_STR);
  $query->bindParam(':usertype',$type,PDO::PARAM_INT);
  $query->execute();
header("location:login.php");
     }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Signup</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="CSS/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
 </head>
</head>
<body>

  <section class="container_fluid">
    <section class="row justify-content-center">
      <section class="col-12 col-sm-6 col-md-3">
      <form class="form_controler" action='' method="post">

<div class="container pt-2 pb-2 my-2 rounded bg-primary text-white text-center"><h3>Registration Form</h3></div>

<!-- First name -->
    <div class="control-group">
      <div class="form-group">
      <input type="text" name="firstname" placeholder="First Name" pattern="[a-zA-Z\s]+" title="First name must contain letters only" class="form-control" required>
    </div>
<!-- last name -->
    <div class="control-group">
      <div class="form-group">
      <input type="text" name="lastname" placeholder="Last Name" pattern="[a-zA-Z\s]+" title="Last name must contain letters only" class="form-control" required>
      </div>
    </div>
<!-- Email -->
    <div class="control-group">
      <div class="form-group">
      <input type="email" name="email" placeholder="E-mail" title="Please enter a valid E-mail" class="form-control" required>
      </div>
    </div>
<!-- Password -->
    <div class="control-group">
      <div class="form-group">
      <input type="password" name="password" placeholder="Password" pattern="^\S{4,}$" class="form-control" required>
      </div>
    </div>
<!-- Confirm Password -->
    <div class="control-group">
      <div class="form-group">
      <input type="password"  name="password_conf" placeholder="password (confirm)" pattern="^\S{4,}$" class="form-control" required>
      </div>
    </div>
<!-- Type -->
    <div class="control-group">
      <label class="control-label" for="usertype">User Type</label>
      <div class="form-group">
        <select name="usertype" class="form-control" required>
    		    <option value="user">User</option>
    				<option value="admin">Admin</option>
    			</select>
      </div>
    </div>
<!-- Button -->
    <div class="control-group">
      <div class="form-group">
      <button class="btn btn-outline-primary btn-block" type="submit" name="signup">Sign up </button>
      Already a member? <a href="login.php">Sign in</a>
      </div>
    </div>
      </form>
    </section>
    </section>
    </section>
</body>
</html>
