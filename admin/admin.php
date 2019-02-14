<?php
/*
manage admin
Edit /delete /add /

*/


$pageTitle='admin manage';

include 'init.php';

check_login();


$do = isset($_GET['do']) ? $_GET['do'] : 'manage';
// Start Manage Page
if($do=='manage'){
  
    

    
			$sql = '';

			if (isset($_GET['page']) && $_GET['page'] == 'Pending') {

				$sql = 'AND RegStatus = 0';
			}
	               $query="SELECT `id`, `username`, `email`,Regstatus ,Date FROM `admin` WHERE `group_id`!=1  $sql";
                        $result=mysqli_query($conn,$query);
                        if(mysqli_num_rows($result)>0)
                        {
                          

							?>
		         <div class="formBox">
			     <h1 class="text-center">Management of admin</h1>
			                    <?php echo msg(); ?>
                                <?php $errors=er(); ?>
                                  <?php errors_function($errors);
                             ?>
			<div class="container">
				<div class="table-responsive">
					<table class="main-table text-center table table-bordered" >
						<tr>
							<td>#ID</td>
							<td>Username</td>
							<td>Email</td>
							<td>Registered Date</td>
							<td>Control</td>
						</tr>
						<?php 
						while($row=mysqli_fetch_assoc($result)){
						
								echo "<tr>";
									echo "<td>" . $row['id'] . "</td>";
									echo "<td>" . $row['username'] . "</td>";
									echo "<td>" . $row['email'] . "</td>";
									echo "<td>" . $row['Date'] ."</td>";
									echo "<td>
										<a href='admin.php?do=Edit&userid=".$row['id'] . "' class='btn btn-success' ><i class='fa fa-edit'></i> Edit</a>
										<a href='admin.php?do=Delete&userid=" . $row['id'] . "' class='btn btn-danger confirm s><i class='fa fa-close'></i> Delete </a>";
										if ($row['Regstatus'] == 0) {
											echo "<a 
													href='admin.php?do=Activate&userid=" . $row['id'] . "' 
													class='btn btn-info activate'>
													<i class='fa fa-check'></i> Activate</a>";
										}
									echo "</td>";
								echo "</tr>";
							}
						?>
					<?php
						  ?>
						<tr>
					</table>
				</div>
				<a href="admin.php?do=Add" class="btn btn-primary">
					<i class="fa fa-plus"></i> New Member
				</a>
			</div>

			<?php } else {

                         echo '<div class="container">';
                    	echo '<div class="nice-message">There\'s No Members To Show</div>';
	                    echo '<a href="admin.php?do=Add" class="btn btn-primary">
			            <i class="fa fa-plus"></i> New Member
	                     	</a>';
                            echo '</div>';

} ?>

			


</div>

<?php  
			}elseif ($do == 'Delete') { // Delete Member Page

				echo "<h1 class='text-center'>Delete Member</h1>";
				echo "<div class='container'>";

					// Check If Get Request userid Is Numeric & Get The Integer Value Of It

					$userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;

					// Select All Data Depend On This ID

					

					// If There's Such ID Show The Form
                     $check=checkItem('id','admin',$userid);
					if($check>0){
					$sql="DELETE FROM `admin` WHERE id={$userid} LIMIT 1";
						$result=mysqli_query($conn,$sql);
							if ( $result && mysqli_affected_rows($conn)>0) {
									
									
								$_SESSION['msg']=secusse_msg_delete();
								redicrt("?do=manage");
									
								}else{
									
									$_SESSION['msg']= error_msg_delete();
									redicrt("?do=manage");
									}
						



					}					


				}elseif ($do == 'Add') { // Add Page ?> 

            <div class="formBox">
			<div class="row">
				<div class="col-sm-12">
					<h1> Add Admin</h1>
					<?php echo msg(); ?>
                                <?php $errors=er(); ?>
                                  <?php errors_function($errors);
                             ?>
				</div>
			</div>

			<form class="form-horizontal" action="?do=insert" method="POST">
			
			<!-- Start Username Field -->
			<div class="row">
				<div class="col-sm-6">
					<div class="inputBox">
						<div class="inputText">User Name</div>
						<input type="text" class="input"  name="username" autocomplete="off" required="required" placeholder="Username To Login Into">
					</div>
				</div>
					<!-- End Username Field -->
					 <!-- Start Password Field -->
				<div class="col-sm-6">
					<div class="inputBox">
						<div class="inputText">Password</div>
						<input  type="password" name="pass" autocomplete="new-password"   required="required" placeholder="Leave Blank If You Dont Want To Change" class="password  input" >
						<i class="show-pass fa fa-eye fa-2x"></i>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-sm-12">
					<div class="inputBox">
						<div class="inputText">Email</div>
						<input  type="email" name="email" class="input"   required="required"  autocomplete="off"placeholder="Email Must Be Valid" >
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
				<input type="submit" value="save" class="btn btn-lg btn-block login_btn" name="submit" >
				</div>
			</div>

			
	</form>
</div>
</div>
</div>





<?php  
//end add page
}elseif($do=='insert'){ //insert page

	                    if(isset($_POST['submit'])){
						$username=mysqli_real_escape_string($conn,check_empty(check_input_admin($_POST["username"])));
						$email=mysqli_real_escape_string($conn,check_empty(check_input_admin($_POST["email"])));
						$pass=mysqli_real_escape_string($conn,check_empty(check_input_admin($_POST["pass"])));
						$pass=check_lenghtpass($_POST["pass"],24,8);
						$pass1=password_hash($pass,PASSWORD_BCRYPT);
					
				if(!empty($errors)){
					$_SESSION['errors']=$errors;
					redicrt('?do=Add');
				}
					
				   $check=checkitem('username','admin',$username);
				   if($check==1){
					$_SESSION['msg']=error_msg_add();
									
					redicrt("?do=Add");

				   }else{


				    $sql="INSERT INTO `admin`(`username`,`email`, `password`,`Regstatus`,`Date` ) VALUES
					('{$username}','{$email}','{$pass1}',1,now())";
						
						    if (mysqli_query($conn, $sql) && mysqli_affected_rows($conn)>0) {
							$_SESSION['msg']=secusse_msg_admin();
				      		redicrt("?do=manage");
							}else{
									$_SESSION['msg']=error_msg_admin();
									redicrt("?do=Add");
									
								}

						}


}//end insert page
}




elseif($do=='Edit'){
	 	// Check If Get Request userid Is Numeric & Get Its Integer Value

		 $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;
		 $query="SELECT * FROM `admin` WHERE id=$userid    LIMIT 1 "   ;
		 $result=mysqli_query($conn,$query);
		 $row=mysqli_fetch_assoc($result);
		 if($result && mysqli_affected_rows($conn)>0)
     {
    
  
    ?>
    
      
               <div class="formBox">
			
						<div class="row">
							<div class="col-sm-12">
								<h1>Contact form</h1>
								
							</div>
						</div>
			
						<form class="form-horizontal" action="?do=Update" method="POST">
						<input type="hidden" name="userid" value="<?php echo $userid ?>" />
						<!-- Start Username Field -->
                    	<div class="row">
							<div class="col-sm-6">
								<div class="inputBox">
									<div class="inputText">User Name</div>
									<input type="text" class="input"  name="username" autocomplete="off" value="<?php echo $row['username'] ?>" required="required" >
								</div>
                            </div>
								<!-- End Username Field -->
					         	<!-- Start Password Field -->
                            <div class="col-sm-6">
								<div class="inputBox">
									<div class="inputText">Password</div>
									<input type="hidden" name="oldpassword" value="<?php echo $row['password'] ?>" />
									<input  type="password" name="newpassword" autocomplete="new-password" placeholder="Leave Blank If You Dont Want To Change" class="input" >
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-sm-12">
								<div class="inputBox">
									<div class="inputText">Email</div>
									<input  type="email" name="email" class="input"  value="<?php echo $row['email'] ?>" required="required"  autocomplete="off" >
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12">
                            <input type="submit" value="save" class="btn btn-lg btn-block login_btn" name="submit" >
							</div>
                        </div>

                        
				</form>
			</div>
		</div>
	</div>
<?php
	}else{
		$_SESSION['msg']=error_msg_edit();//message error
		 echo msg(); 
		 $errors=er(); 
		
	}

}elseif ($do == 'Activate') {

		echo "<h1 class='text-center'>Activate Member</h1>";
		echo "<div class='container'>";

			// Check If Get Request userid Is Numeric & Get The Integer Value Of It

			$userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;

			// Select All Data Depend On This ID

				$check=checkItem('id','admin',$userid);
				if($check>0){
				$sql="UPDATE  `admin` SET `Regstatus`=1  WHERE id={$userid} LIMIT 1";
					$result=mysqli_query($conn,$sql);
						if ( $result && mysqli_affected_rows($conn)>0) {
								
								
							$_SESSION['msg']=secusse_msg_delete();
							redicrt("?do=manage");
								
							}else{
								
								$_SESSION['msg']= error_msg_delete();
								redicrt("?do=manage");
								}
					



				}					


			

	
}elseif ($do == 'Update') { // Update Page

				echo "<h1 class='text-center'>Update Member</h1>";
				echo "<div class='container'>";
				echo msg(); 
				$errors=er(); 
   
            	if(isset($_POST['submit'])){

		        $id 	= $_POST['userid'];
				$email 	= $_POST['email'];
				$user=mysqli_real_escape_string($conn,($_POST["username"]));
				$email=mysqli_real_escape_string($conn,($_POST["email"]));
				// Password Trick
				$pass1 = empty($_POST['newpassword']) ? $_POST['oldpassword'] : password_hash($_POST['newpassword'],PASSWORD_BCRYPT);
			    
					  
				      $sql="UPDATE  `admin` SET`username`='{$user}',`email`='{$email}', `password`='{$pass1}'
					   WHERE id='{$id}'  ";

					   if (mysqli_query($conn, $sql) && mysqli_affected_rows($conn)>0) {
						$_SESSION['msg']=secusse_msg_Edit();
						  redicrt("?do=manage");
					   }else{
						   $_SESSION['msg']=error_msg_change();
						   redicrt('?do=manage');
						   
					   }
					
	}
}
?>
<?php

include $tpl.'footer.php';
?>
