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
  
    

    
			$sql ='';

			if (isset($_GET['page']) && $_GET['page'] == 'Pending') {

				$sql = 'AND RegStatus = 0';
			}
	               $query="SELECT `id`, `username`, `email`,Regstatus ,group_id,`level`,Date FROM `admin` WHERE `group_id`!=1  $sql";
                        $result=mysqli_query($conn,$query);
                        if(mysqli_num_rows($result)>0)
                        {
                          

				?>
				<!-- admin area strat -->
		         <div class="formBox">
				 <h1 class="text-center">Management of employee</h1>

			                    <?php echo msg(); ?>
                                <?php $errors=er(); ?>
                                  <?php errors_function($errors);
                                 ?>
								 <!--
			<div class="container">
			<a href="admin.php?do=Add" class="btn btn-primary" style="margin-bottom: 14px;">
					<i class="fa fa-plus"></i> New employee
				</a> -->
				<!--tabel admin info start -->
				<div class="table-responsive">
					<table class="main-table text-center table table-bordered" >
						<tr>
							<td>#ID</td>
							<td>Username</td>
							<td>Email</td>
							<td>Level</td>
							<td>Registered Date</td>
							<td>Control</td>
						</tr>
						<?php 
						while($row=mysqli_fetch_assoc($result)){
						
								    echo "<tr>";
									echo "<td>" . $row['id'] . "</td>";
									echo "<td>" . $row['username'] . "</td>";
									echo "<td>" . $row['email'] . "</td>";
									echo "<td>" ;

									if($row['level']==1){
										echo "Division registration";

									}elseif($row['level']==2){
										echo "Accounts";
										
									
									}elseif($row['level']==3)
									{
										echo "department";
									}
									elseif($row['level']==4){
										echo "Sports Unit";
									}
									elseif($row['level']==5){
										echo "Free education";
								
									}	elseif($row['level']==6){
										echo "College Library";
									}
									elseif($row['level']==7){
										echo "Central Library";
									}
									elseif($row['level']==8){
										echo "Internal_section";
									}
									echo "</td>";
									echo "<td>" . $row['Date'] ."</td>";
									echo "<td>
										<a href='admin.php?do=Edit&userid=".$row['id'] . "' class='btn btn-success' ><i class='fa fa-edit'></i> Edit</a>
										<a href='admin.php?do=Delete&userid=" . $row['id'] . "' class='btn btn-danger confirm s><i class='fa fa-close'></i> Delete </a>";
										if ($row['Regstatus'] == 0) {
											echo "<a 
													href='admin.php?do=Activate&userid=" . $row['id'] . "' 
													class='btn btn-info activate'>
													<i class='fa fa-check'></i> Activate</a>";
										}if($row['group_id']==0 && $row['level']==0)
										{
											echo "<a 
											href='admin.php?do=admins&userid=" . $row['id'] . "' 
											class='btn btn-info activate'>
											<i class='fa fa-check'></i>adminstration</a>";	
										}
									echo "</td>";
								echo "</tr>";
							}
						?>
					<?php
						  ?>
						<tr>

					</table>
					<!-- table end -->
				</div>
				<!-- butten add new admin -->
				<a href="admin.php?do=Add" class="btn btn-primary">
					<i class="fa fa-plus"></i> New employee
				</a>
				<!--end butten -->
			
			</div>

			<?php } 
			//if not found admin show butten add
			else {

                     echo '<div class="container">';
                    	echo '<div class="nice-message">There\'s No Members To Show</div>';
	                    echo '<a href="admin.php?do=Add" class="btn btn-primary">
			         		  <i class="fa fa-plus"></i> New employee
	                        	</a>';
                     echo '</div>';

						} ?>

			


</div>
<!--end manage page -->
<?php  

	     	}elseif ($do == 'Delete') { // Delete admin Page

				echo "<h1 class='text-center'>Delete Member</h1>";
				echo "<div class='container'>";

					// Check If Get Request userid Is Numeric & Get The Integer Value Of It
 
					$userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;
					$type=1;
                    $admincheck=checkadmin('id','admin',$userid,'group_id',$type);

					// Select All Data Depend On This ID

					// If There's Such ID Show The Form
					 $check=checkItem('id','admin',$userid);
					if($check>0){
				   if($admincheck>0)
				   {
					   		
					$_SESSION['msg']=error_msg_delete();
					redicrt("?do=manage");
				   }
				   else{

				   
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
				}				
//end delete page

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
           <!-- Start Email Field -->
			<div class="row">
				<div class="col-sm-3">
					<div class="inputBox">
						<div class="inputText">Email</div>
						<input  type="email" name="email" class="input"   required="required"  autocomplete="off"placeholder="Email Must Be Valid" >
					</div>
				</div>
			<!-- end  Email Field -->
		        <!-- Start department Field -->
				<div class="col-sm-3">
					<div class="inputBox" style="color: black;">
						<div class="inputText" style="color: white;" >Coleges</div>
                        <select name="College_Name"  class="input" >
								<option value="0"></option>
                                <?php
                                 $query="SELECT `id_Colleges`, `name_Colleges` FROM `colleges` ";
                                 $result=mysqli_query($conn,$query);
                                 $row=mysqli_fetch_all($result,MYSQLI_ASSOC);
                                 foreach ($row as $u){
                                    echo "<option value='" . $u['id_Colleges'] . "'>" . $u['name_Colleges'] . "</option>";
                                }
                                ?>
                       </select>
					</div>
				</div>
				<!--end dapatrment-->
		 <!-- Start colloge Field -->
			<div class="col-sm-3">
					<div class="inputBox" style="color: black;">
						<div class="inputText" style="color: white;" >department</div>
                        <select name="department"  class="input" >
								<option value="0"></option>
                                <?php
                                 $query="SELECT `id_department`, `name_department` FROM `department` ";
                                 $result=mysqli_query($conn,$query);
                                 $row=mysqli_fetch_all($result,MYSQLI_ASSOC);
                                 foreach ($row as $u){
                                    echo "<option value='" . $u['id_department'] . "'>" . $u['name_department'] . "</option>";
                                }
                                ?>
                       </select>
					</div>
				</div>
				<!--end colloge -->
				<!-- Start status Field -->
				<div class="col-sm-3">
					<div class="inputBox" style="color: black;">
						<div class="inputText" style="color: white;" >type</div>
                        <select name="status" class="input">
								<option value="0"></option>
								<option value="1">Division registration</option>
								<option value="2">Accounts</option>
								<option value="3">department</option>
								<option value="4">Sports Unit</option>
								<option value="5">Free education</option>
								<option value="6">College Library</option>
								<option value="7">Central Library</option>
								<option value="8">Internal_section</option>
							</select>
                      
					</div>
				</div>
				</div>
				<!-- end status Field -->
             <!-- Start butten-->
			<div class="row">
				<div class="col-sm-12">
				<input type="submit" value="save" class="btn btn-lg btn-block login_btn" name="submit" >
				</div>
			</div>
       <!-- end butten  -->
			
	</form>
	<!-- end form -->
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
						$college=$_POST["College_Name"];
						$department=$_POST["department"];
						$stauts=$_POST["status"];
					
				if(!empty($errors)){
					$_SESSION['errors']=$errors;
					redicrt('?do=Add');
				}
					
				   $check=checkitem('username','admin',$username);
				   if($check==1){
					$_SESSION['msg']=error_msg_add();
									
					redicrt("?do=Add");

				   }else{


				    $sql="INSERT INTO `admin`(`username`,`email`, `password`, 
					 `Regstatus`, `Date`, `id_collegee`, `id_department`, `level`) VALUES
					('{$username}','{$email}','{$pass1}',1,now(),'{$college}','{$department}','{$stauts}')";
						
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
								<h1>Edit information</h1>
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
							<div class="col-sm-3">
								<div class="inputBox">
									<div class="inputText">Email</div>
									<input  type="email" name="email" class="input"  value="<?php echo $row['email'] ?>" required="required"  autocomplete="off" >
								</div>
							</div>
                 <!--college start -->
				<div class="col-sm-3">
					<div class="inputBox" style="color: black;">
						<div class="inputText" style="color: white;" >Coleges</div>
                        <select name="College_Name"  class="input" >
								<option value="0"></option>
                                <?php
                                 $query="SELECT `id_Colleges`, `name_Colleges` FROM `colleges` ";
                                 $result=mysqli_query($conn,$query);
                                 $row1=mysqli_fetch_all($result,MYSQLI_ASSOC);
                                 foreach ($row1 as $u){
									echo "<option value='" . $u['id_Colleges'] . "'";
									if ($row['id_collegee']== $u['id_Colleges']) 
                                    { 
                                        echo 'selected';
                                    
                                    }
                                    
									echo ">" . $u['name_Colleges'] . "</option>";
                                }
                                ?>
                       </select>
					</div>
				</div>
				  <!--department start -->
			<div class="col-sm-3">
					<div class="inputBox" style="color: black;">
						<div class="inputText" style="color: white;" >department</div>
                        <select name="department"  class="input" >
								<option value="0"></option>
                                <?php
                                 $query="SELECT `id_department`, `name_department` FROM `department` ";
                                 $result=mysqli_query($conn,$query);
                                 $row1=mysqli_fetch_all($result,MYSQLI_ASSOC);
                                 foreach ($row1 as $u){
									echo "<option value='" . $u['id_department'] . "'";
									if ($row['id_department']== $u['id_department']) 
                                    { 
                                        echo 'selected';
                                    
                                    }
									echo ">". $u['name_department'] . "</option>";
                                }
                                ?>
                       </select>
					</div>
				</div>
				<!--end department faild -->
				<!--status start -->
				<div class="col-sm-3">
					<div class="inputBox" style="color: black;">
						<div class="inputText" style="color: white;" >type</div>
                        <select name="status" class="input">
								<option value="0"></option>
								<option value="1"<?php if ($row['level'] == 1) { echo 'selected'; } ?>>Division registration</option>
								<option value="2"<?php if ($row['level'] == 2) { echo 'selected'; } ?>>Accounts</option>
								<option value="3"<?php if ($row['level'] == 3) { echo 'selected'; } ?>>department</option>
								<option value="4"<?php if ($row['level'] == 4) { echo 'selected'; } ?>>Sports Unit</option>
								<option value="5"<?php if ($row['level'] == 5) { echo 'selected'; } ?>>Free education</option>
								<option value="6"<?php if ($row['level'] == 6) { echo 'selected'; } ?>>College Library</option>
								<option value="7"<?php if ($row['level'] == 7) { echo 'selected'; } ?>>Central Library</option>
							</select>
                      
					</div>
				</div>
				</div>








						</div>
						<!-- butten start -->
						<div class="row">
							<div class="col-sm-12">
                            <input type="submit" value="save" class="btn btn-lg btn-block login_btn" name="submit" >
							</div>
                        </div>
                   <!--end butten -->
                        
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
								
								
							$_SESSION['msg']=secusse_msg_activate();
							redicrt("?do=manage");
								
							}else{
								
								$_SESSION['msg']= error_msg_activate();
								redicrt("?do=manage");
								}
					



				}
			}					


			
//end activate page
	
				elseif ($do == 'admins') {

					echo "<h1 class='text-center'> Member</h1>";
					echo "<div class='container'>";
			
						// Check If Get Request userid Is Numeric & Get The Integer Value Of It
			
						$userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;
			
						// Select All Data Depend On This ID
			
							$check=checkItem('id','admin',$userid);
							if($check>0){
							$sql="UPDATE  `admin` SET `group_id`=1  WHERE id={$userid} LIMIT 1";
								$result=mysqli_query($conn,$sql);
									if ( $result && mysqli_affected_rows($conn)>0) {
											
											
										$_SESSION['msg']=secusse_msg_Edit();
										redicrt("?do=manage");
											
										}else{
											
											$_SESSION['msg']= error_msg_change();
											redicrt("?do=manage");
											}
								
			
			
			
							}					
			
			
						
			
				
			}




elseif ($do == 'Update') { // Update Page

				echo "<h1 class='text-center'>Update Member</h1>";
				echo "<div class='container'>";
				echo msg(); 
				$errors=er(); 
   
            	if(isset($_POST['submit'])){

		        $id 	= $_POST['userid'];
				$email 	= $_POST['email'];
				$user=mysqli_real_escape_string($conn,($_POST["username"]));
				$email=mysqli_real_escape_string($conn,($_POST["email"]));
				$college=$_POST["College_Name"];
				$department=$_POST["department"];
				$stauts=$_POST["status"];
				// Password Trick
				$pass1 = empty($_POST['newpassword']) ? $_POST['oldpassword'] : password_hash($_POST['newpassword'],PASSWORD_BCRYPT);
			    
					  
				      $sql="UPDATE  `admin` SET`username`='{$user}',`email`='{$email}', `password`='{$pass1}',
					  `id_collegee`='{$college}',`id_department`='{$department}',`level`='{$stauts}'
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
