<?php
// starting the session
session_start();
//Database Configuration File
include('dbconn.php');
// Validating Session
if(strlen($_SESSION['user_login'])== 0)
 {
   echo "ERROR!";
header('location:register.php');
 }
else{
// Code for fecthing username.
  $user_login=$_SESSION['user_login'];
  $query=$conn->prepare("SELECT * FROM userdata WHERE email='$user_login'");
         $query->execute();
  $results=$query->fetchAll(PDO::FETCH_OBJ);
  $username = $results[0]->first_name;
  $type = $results[0]->type;

// Deleteing a record
  if(isset($_POST['delete'])) {
     $task_delete = $_POST['delete'];
     if ($type == 'admin') {
     $comand_delete = "DELETE FROM userdata WHERE id =$task_delete";
     $conn->exec($comand_delete);
     header('location: home.php');
     }
     else {
       echo "<script>alert('Only An Admin User Can Use This Action');</script>";
          }
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
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
</head>
<body>
  <div class="container_fluid">
    <div class="row">
      <div class="BOX">
    <nav>
 <div class="container">
    <ul class="nav nav-tabs">
      <li class="nav-item active">
        <a class="nav-link" href="home.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="posts.php">Posts</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="add_post.php">Link</a>
      </li>
      <li class="nav-item pull-right">
        <a href="logout.php" class="">Logout</a>
      </li>
    </ul>
 </div>
    </nav>

 <div class="container">
          <h1>Welcome <font face="Time new rome" color="#0095b6"><?php echo $username;?></font></h1>
 </div>

 <div class="Title">
   <h2>Users:</h2>
 </div>

 <form method="post" class="input_form">
     <a href="add_post.php" type="submit" name="posts" class="btn btn-info text-white" value="">Add a post</a>
 </form>

<div class="container">
  <form method="post">
       <table class="table table-hover">
       <thead>
         <tr>
              <th>Number</th>
              <th>First Name</th>
              <th>Last Name</th>
              <th>E-mail</th>
              <th>Actions</th>
         </tr>
       </thead>
       <tbody>
<?php
// fetching data to dispaly in table
         			$n=1;
         			$data = $conn->query("SELECT * FROM userdata")->fetchAll();
         		 		foreach ($data as $row) {
?>
         <tr>
             <td class="number"><?php echo $n?></td>
         	   <td class="firstname"><?php echo $row['first_name'];?></td>
          	 <td class="lastname"><?php echo $row['last_name']; ?></td>
             <td class="email"><?php echo $row['email']; ?></td>
             <td><button type="submit" class="btn btn-info text-white" name="delete" value="<?php echo $row['id']; ?>">X</button></td>
         </tr>
<?php $n++; }  ?>
       </tbody>
       </table>
  </form>
</div>
        </div>
      </div>
    </div>
</body>
</html>
