<?php
// include database connection file
require_once'dbconn.php';
// // starting the session
session_start();
// Code for fecthing information from session
$logied_user_id = $_SESSION["user_id"];
$post_id = intval($_GET['id']);

// code for updating information in the data base
if (isset($_POST['submit'])) {
$title_edit = $_POST['title_textarea'];
$body_edit = $_POST['body_textarea'];
$comand_edit = "UPDATE posts SET  title='$title_edit' , body='$body_edit' WHERE id=$post_id";
$conn->exec($comand_edit);
header('location: posts.php');
}

 ?>
<!DOCTYPE html>
<html>
<head>
  <title>PostEdit</title>
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

          <form class="form_controler" id="loginForm" method="post">
    <div class="container align-items-center ">
<?php
$data = $conn->query("SELECT userdata.id,posts.title,posts.body,posts.id,posts.user_id
                       FROM userdata INNER JOIN posts ON userdata.id = posts.user_id")->fetchAll();
                       foreach ($data as $row) {
$sam = $row['id'];
// an IF condetion to make sure that the only post that is being displayed is the one that has been clicked on.
                                          if ($sam == $post_id) {
?>
    <div class="form-group">
      <h3 for="title_textarea">Title</h3>
      <P>You can edit your title here</p>
    <textarea class="form-control text-center" rows="1" name="title_textarea"><?php echo $row['title']; ?></textarea>
     </div>

     <div class="form-group">
       <h3 for="body_textarea">Body</h3>
       <P>You can change the content of your artical here</p>
        <textarea class="form-control ckeditor" rows="10" name="body_textarea"><?php echo $row['body']; ?></textarea>
     </div>
<?php }}?>
        <button type="submit" name="submit" class="btn btn-info text-white p-6">Submit</button>

    </div>
          </form>
    </div>
    </div>
    </div>
</body>
</html>
