<?php
// // starting the session
session_start();
// //Database Configuration File
include('dbconn.php');
// // Validating Session
if(strlen($_SESSION['user_login'])== 0)
 {
   echo "ERROR!";
header('location:register.php');
 }
else {
// Code for fecthing information from session
  $user_login=$_SESSION['user_login'];
  $user_id=$_SESSION["user_id"];
// submmiting comments to database
if(isset($_POST['submit'])) {
  $comment=$_POST['comment'];
  $post_id = $_POST['submit'];
  $sql="INSERT INTO comment (post_id,user_id,comment) VALUES ('$post_id','$user_id','$comment')";
  $query = $conn->prepare($sql);
  $query->bindParam(':comment',$comment,PDO::PARAM_STR);
  $query->execute();
  header('location: posts.php');
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

                                  <!-- posts section -->

<div class="POST_BOX">
<h1>USER POSTS</h1>

<?php
//  fetching the necesary data from TWO diffrent tables and INNER joining them in one.
  $n_posts=1;
      $query=$conn->query("SELECT userdata.id, userdata.first_name,userdata.last_name,posts.title,posts.body,posts.id,posts.user_id
                             FROM userdata INNER JOIN posts ON userdata.id = posts.user_id")->fetchAll();
                             foreach ($query as $post) {
?>
  <table align="center">
    <thead><tr><th class="title"><?php echo $post['title'];?><hr class="style-two"></hr><?php echo $post['first_name'],$post['last_name'] ?></th></tr></thead>
<br>
   <tbody>
           <tr><td class="body" style="padding-top: 20px;"><?php echo $post['body'] ?></td></tr>
<?php
// code to make suer only the post creater can alter
    $pu= $post['user_id'];
    if ($user_id == $pu ) {
?>

           <tr align="left"><td><a href="edit_post.php?id=<?php echo $post['id'];?>" type="submit" class="Button" name="edit" value="<?php echo $post['id']; ?>">Edit</a></td></tr>
<?php } ?>
   </tbody>
 </table>

                                  <!-- comment section -->

<div class="COMMENTS_BOX" >

        <form method="POST">
          <table class="COMMENT_ADD" align= "center">
<tr>
<td><label for="comment">Comment :</label></td>
<td><textarea name="comment" rows="2" cols="500" required></textarea></td>
<td colspan="2" align="right"><button type="submit" name="submit" value="<?php echo $post['id']; ?>" class="btn btn-info text-white">Submit</button></td>
</tr>
        </table>
        </form>
        <hr class="style-two"></hr>

                                  <!-- presenting comments section -->

<?php
//  fetching the necesary data from three diffrent tables and joining them in one.
    $n_comments=1;
    $data = $conn->query("SELECT userdata.id, userdata.first_name,userdata.last_name,comment.post_id,comment.comment,comment.date,posts.id
                          FROM userdata
                          JOIN comment ON userdata.id = comment.user_id
                          JOIN Posts ON Posts.id = comment.post_id")->fetchAll();
                          foreach ($data as $comments) {
$sam = $post['id'];
$dan = $comments['post_id'];
// an IF condetion to make sure that the only comments that are being presented are the ones that are related to the post.
                          if ($sam == $dan ) {
  ?>


    <table class="COMMENT_POSTED" align= "center">
        <tr>
        <td width="90px"><?php  echo $comments['first_name']; echo $comments['last_name'] ?></td>
        <td width="600px" ><?php  echo $comments['comment']; ?></td>
        <td><?php  echo $comments['date']; ?></td>
        </tr>
<?php $n_comments++; } } ?>
    </table>

</div>
<?php $n_posts++; } } ?>
</div>

</div>
</div>
</div>
</body>
</html>
