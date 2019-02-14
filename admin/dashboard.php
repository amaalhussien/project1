<?php
   	ob_start(); // Output Buffering Start
   $pageTitle='Dashboard';

     include 'init.php';
     check_login();

	 $numUsers = 6; // Number Of Latest Users
 
     $latestUsers = getLatest('*', "admin", "id", $numUsers); // Latest Users Array

  
?> 
       <div class="formBox">
      <div class="home-stats">
			<div class="container text-center">
				<h1>Dashboard</h1>
				<div class="row">
					<div class="col-md-3">
						<div class="stat st-members">
							<i class="fa fa-users"></i>
							<div class="info">
								Total Members
								<span>
									<a href="admin.php?do=manage"><?php echo countItems('id', 'admin') ?></a>
								</span>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="stat st-pending">
							<i class="fa fa-user-plus"></i>
							<div class="info">
								Pending Members
								<span>
									<a href="admin.php?page=Pending">
										<?php echo checkItem("RegStatus", "admin", 0) ?>
									</a>
								</span>
							</div>
						</div>
					</div>
					
				
				</div>
			</div>
		</div>

		<div class="latest">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<div class="panel panel-default">
							<div class="panel-heading">
								<i class="fa fa-users"></i> 
								Latest <?php echo $numUsers ?> Registerd Users 
								<span class="toggle-info pull-right">
									<i class="fa fa-plus fa-lg"></i>
								</span>
							</div>
							<div class="panel-body">
								<ul class="list-unstyled latest-users">
								<?php 
									if (! empty($latestUsers)) {
										foreach ($latestUsers as $user){
											echo '<li>';
												echo $user['username'];
												echo '<a href="admin.php?do=Edit&userid=' . $user['id'] . '">';
													echo '<span class="btn btn-success pull-right">';
														echo '<i class="fa fa-edit"></i> Edit';
														if ($user['Regstatus'] == 0) {
															echo "<a 
																	href='admin.php?do=Activate&userid=" . $user['id'] . "' 
																	class='btn btn-info pull-right activate'>
																	<i class='fa fa-check'></i> Activate</a>";
														}else
														{
															echo "	<a 
																	href='admin.php?do=Activate&userid=" . $user['id'] . "' 
																	class='btn btn-info pull-right activate'>
																	<i class='fa fa-check'></i> NOT actives</a>";
														}
														
													echo '</span>';
												echo '</a>';
											echo '</li>';
										
									} }else {
										echo 'There\'s No Members To Show';
									}
							?>
								</ul>
							</div>
						</div>
					</div>
				
				<!-- End Latest Comments -->
			</div>
		</div>
 
 </div>
 
 
 
        
  
  
  









<?php
	ob_end_flush(); // Release The Output

include $tpl.'footer.php';
?>
