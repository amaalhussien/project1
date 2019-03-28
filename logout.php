<?php

  session_start();


?>

<?php
include_once('inc/session/session.php');
include_once('inc/function/function.php'); 

$_SESSION['user_id']=null;
$_SESSION['user_name']=null;

$_SESSION['admin_id']=null;
 $_SESSION['admin_name']=null;

 redicrt('index.php');
 ?>
