<?php
 session_start();
 ?>
<?php
 $noNavbar=' ';
 $pageTitle='log in';
include 'init.php';


?>
<?php
     // Check If User Coming From HTTP Post Request
     if(isset($_POST['submit'])){
     $username=htmlentities($_POST['username']);
     $pass=($_POST['pass']);
    
     $username1=mysqli_real_escape_string($conn,$username);
     $pass1=mysqli_real_escape_string($conn,$pass);
     $sql="SELECT  id,`username`,`password`,`group_id` FROM`admin` WHERE `username`='{$username1}' LIMIT 1";
     $result=mysqli_query($conn,$sql);
     $row=mysqli_fetch_assoc($result);
      // If Count > 0 This Mean The Database Contain Record About This Username
        if($result && mysqli_affected_rows($conn)>0)
        {
            $_SESSION['admin_id']=$row['id'];
            $_SESSION['admin_name']=$row['username'];
            $_SESSION['type']=$row['group_id'];

            if(password_verify($pass1,$row['password']))
            {
                redicrt('dashboard.php');// Redirect To Dashboard Page
            }else{
               
             $_SESSION['msg']=error_msg_login();//message error
             redicrt('index.php');//Redirect To index page
            }
        }else{
            
            $_SESSION['msg']=error_msg_login();//message error
            redicrt('index.php');//Redirect To index page
        }
    
    }

    ?>









<body style="bacground-color:#000;">
<!-- Page Content -->
<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
                <center>
                <h3>Admin Login</h3>
                <?php echo msg(); ?>
                <?php $errors=er(); ?>
                
                </center>
			</div>
			<div class="card-body">
                 <form  action="index.php" method='POST' >
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-user" aria-hidden="true"></i></span>
						</div>
						<input name="username" type="text" class="form-control" placeholder="username"  autocomplete="off" >
						
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-key" aria-hidden="true"></i></span>
						</div>
						<input type="password" class="form-control" name="pass" placeholder="password" autocomplete="new-password">
					</div>
					
					<div class="form-group">
						<input type="submit" value="Login" class="btn btn-lg btn-block login_btn" name="submit" >
					</div>
				</form>
			</div>
           





</body>


<?php

include $tpl.'footer.php';
?>