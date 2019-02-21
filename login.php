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
     $sql="SELECT  id,`username`,`password`,`group_id`,`level`,id_collegee,id_department FROM`admin` WHERE `username`='{$username1}' AND Regstatus=1
      LIMIT 1";
     $result=mysqli_query($conn,$sql);
     $row=mysqli_fetch_assoc($result);
      // If Count > 0 This Mean The Database Contain Record About This Username
        if($result && mysqli_affected_rows($conn)>0)
        {
            $_SESSION['user_id']=$row['id'];
            $_SESSION['user_name']=$row['username'];
            $_SESSION['type']=$row['group_id'];
            $_SESSION['level']=$row['level'];
            $_SESSION['college']=$row['id_collegee'];
            $_SESSION['department']=$row['id_department'];


            if(password_verify($pass1,$row['password']))
            {
               if($_SESSION['level']==1){
               redicrt('registr.php');

               }elseif($_SESSION['level']==2){
                 redicrt('accounts.php');

               }elseif($_SESSION['level']==3){
                  redicrt('department.php');

               }elseif($_SESSION['level']==4){
                redicrt('sports_unit.php');

             }elseif($_SESSION['level']==3){
                redicrt('department.php');
             }elseif($_SESSION['level']==3){
                redicrt('department.php');
             }elseif($_SESSION['level']==3){
                redicrt('department.php');
             }elseif($_SESSION['level']==3){
                redicrt('department.php');
             }

            }
            
            
            
            
            
            
            
            
            
            
            else{
               
            
            }
        }else{
            
           
           
        }
    
    }

    ?>










<!-- Page Content -->
<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
                <center>
                <h3>Employe Login</h3>
                <?php echo msg(); ?>
                <?php $errors=er(); ?>
                
                </center>
			</div>
			<div class="card-body">
                 <form  action="login.php" method='POST' >
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
           






