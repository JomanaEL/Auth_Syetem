<?php
session_start();
unset($_SESSION['user_login']); // unset session variable
session_destroy(); // destroy session
header("location:login.php");
?>
