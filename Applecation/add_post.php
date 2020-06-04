<?php
// starting the session
session_start();
// Database Configuration File
include('dbconn.php');
// Validating Session
if(strlen($_SESSION['user_login'])== 0)
 {
   echo "ERROR!";
header('location:login.php');
 }

else {
// echo  $_SESSION["user_id"] . $_SESSION["user_login"];
// die();
if(isset($_POST['submit'])) {
  // Getting Post Values
  $title=$_POST['title'];
  $body=$_POST['body_textarea'];
  $user_id=$_SESSION["user_id"];
  // echo  $_SESSION["user_id"] . $body . $title;
  // die();
  // Query for Insertion
    $sql="INSERT INTO posts (title,body,user_id) VALUES ('$title','$body','$user_id')";
    $query = $conn->prepare($sql);

  // Binding Post Values
    $query->bindParam(':title',$title,PDO::PARAM_STR);
    $query->bindParam(':body',$body,PDO::PARAM_STR);
    $query->execute();
    header("location:posts.php");

}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Home</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="CSS/style_welcome.css">
    <script src="ckeditor/ckeditor.js"></script>
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
</head>
<body>
  <div class="container_fluid">
    <div class="row">
      <div class="BOX">
<!-- Navegations Bar -->
        <nav>
     <div class="container">
        <ul class="nav nav-tabs">
          <li class="nav-item">
            <a class="nav-link" href="home.php">Home</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="posts.php">Posts</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>
          <li class="nav-item pull-right">
            <a href="logout.php" class="">Logout</a>
          </li>
        </ul>
     </div>
        </nav>
<!-- Post Form -->
        <form class="form_controler" id="loginForm" method="post">
<div class="container pt-2 pb-2 my-2 rounded bg-primary text-left">

  <div class="form-group">
    <h3 for="title">Title</h3>
    <P>Be specific and creative with your title</p>
  <input type="text" class="form-control"  name="title" placeholder="" required>
   </div>

   <div class="form-group">
     <h3 for="body_textarea">Body</h3>
     <P>Include all the information that you would want to present here</p>
      <textarea class="ckeditor" rows="10" name="body_textarea" required></textarea>
   </div>

      <button type="submit" name="submit" class="btn btn-info text-white">Submit</button>

</div>
        </form>
</div>
</div>
</div>
</body>
</html>
