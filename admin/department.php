<?php
ob_start(); // Output Buffering Start
$pageTitle='colleges manage';


include 'init.php';
check_login();


$do = isset($_GET['do']) ? $_GET['do'] : 'manage';

       $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

       if ($do == 'Manage') { 
           
        $query="SELECT `id_department`, `name_department`, `description` FROM `department` ";
        $result=mysqli_query($conn,$query);
        if(mysqli_num_rows($result)>0)
        {
            ?>
            <div class="formBox">
            <h1 class="text-center">Management of department </h1>
                           <?php echo msg(); ?>
                           <?php $errors=er(); ?>
                          <?php errors_function($errors);
                        ?>
       <div class="container">
           <div class="table-responsive">
               <table class="main-table text-center table table-bordered" >
                   <tr>
                       <td>#ID</td>
                       <td>name_department</td>
                       <td>description</td>
                       <td>Control</td>
                   </tr>
                   <?php 
                   while($row=mysqli_fetch_assoc($result)){
                   
                           echo "<tr>";
                               echo "<td>" . $row['id_department'] . "</td>";
                               echo "<td>" . $row['name_department'] . "</td>";
                               echo "<td>" . $row['description'] . "</td>";
                               echo "<td>
                                   <a href='colleges.php?do=Edit&id_Colleges=".$row['id_department'] ."' class='btn btn-success' ><i class='fa fa-edit'></i> Edit</a>
                                   <a href='colleges.php?do=Delete&id_Colleges=" . $row['id_department'] . "' class='btn btn-danger confirm s><i class='fa fa-close'></i> Delete </a>";
                               echo "</td>";
                           echo "</tr>";
                   } 
                
                
    
                ?>
               
                </table>
            </div>
            <a href="colleges.php?do=Add" class="btn btn-primary">
                <i class="fa fa-plus"></i> ADD_Colleges
            </a>
        </div>
     
                <?php }else {

echo '<div class="container">';
echo '<div class="nice-message">There\'s No Members To Show</div>';
echo '<a href="colleges.php?do=Add" class="btn btn-primary">
<i class="fa fa-plus"></i> New Member
    </a>';
   echo '</div>';

} 
 ?>
        
    
    
    
    
<?php    }elseif ($do == 'Add') {//page Add start
?>
  <div class="formBox">
  <div class="row">
      <div class="col-sm-12">
          <h1> Add colleges</h1>
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
              <div class="inputText">name_Colleges</div>
              <input type="text" class="input"  name="name_colleges" autocomplete="off" required="required" placeholder="Username To Login Into">
          </div>
      </div>
    
          <!-- End Username Field -->
          <div class="col-sm-6">
					<div class="inputBox">
						<div class="inputText">Colleges</div>
                        <select name="member"  class="input" style="
                                                                    color: black;"
                                                                    
                        >
								<option value="0">...</option>
                                <?php
                                 $query="SELECT `id_Colleges`, `name_Colleges`, `description` FROM `colleges` ";
                                 $result=mysqli_query($conn,$query);
                                 $row=mysqli_fetch_all($result,MYSQLI_ASSOC);
                                 foreach ($row as $u){
                                    echo "<option value='" . $u['id_Colleges'] . "'>" . $u['name_Colleges'] . "</option>";
                                }
                                ?>
                       </select>
					</div>
				</div>
			</div>
         
           <!-- Start Password Field -->
      
   
  <div class="row">
      <div class="col-sm-12">
          <div class="inputBox">
              <div class="inputText"> description</div>
              <textarea  type="email" name="description" class="input"   required="required"  autocomplete="off"placeholder="Email Must Be Valid"  rows="5"
              ></textarea>
          </div>
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


       } elseif ($do == 'Insert') {


       } elseif ($do == 'Edit') {


       } elseif ($do == 'Update') {


       } elseif ($do == 'Delete') {


       } elseif ($do == 'Activate') {


       }else
       {




        
       }

   

   

  
?>
<?php
ob_end_flush(); // Release The Output
include $tpl.'footer.php';
?>
