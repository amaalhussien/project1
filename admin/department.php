<?php
ob_start(); // Output Buffering Start
$pageTitle='colleges manage';


include 'init.php';
check_login();


$do = isset($_GET['do']) ? $_GET['do'] : 'manage';

     

       if ($do == 'manage') { 
           
        $query="SELECT department.*, 
                    colleges.name_Colleges AS College_Name
                             FROM 
                             department
                         INNER JOIN 
                         colleges 
                            ON 
                            colleges.id_Colleges=department.college_id
                         ";

        
        
        
        
        
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
                       <td>name_Colleges</td>
                       <td>name_department</td>
                       <td>description</td>
                       <td>Control</td>
                   </tr>
                   <?php 
                   while($row=mysqli_fetch_assoc($result)){
                   
                           echo "<tr>";
                               echo "<td>" . $row['id_department'] . "</td>";
                               echo "<td>" . $row['College_Name'] . "</td>";
                               echo "<td>" . $row['name_department'] . "</td>";
                               echo "<td>" . $row['description'] . "</td>";

                               echo "<td>
                                   <a href='department.php?do=Edit&id=".$row['id_department'] ."' class='btn btn-success' ><i class='fa fa-edit'></i> Edit</a>
                                   <a href='department.php?do=Delete&id=" . $row['id_department'] . "' class='btn btn-danger confirm s><i class='fa fa-close'></i> Delete </a>";
                               echo "</td>";
                           echo "</tr>";
                   } 
                
                
    
                ?>
               
                </table>
            </div>
            <a href="department.php?do=Add" class="btn btn-primary">
                <i class="fa fa-plus"></i> ADD_Colleges
            </a>
        </div>
     
                <?php }else {

                                echo '<div class="container">';
                                echo '<div class="nice-message">There\'s No Members To Show</div>';
                                echo '<a href="department.php?do=Add" class="btn btn-primary">
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
          <h1> Add department </h1>
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
              <div class="inputText">name_department</div>
              <input type="text" class="input"  name="name_department" autocomplete="off" required="required" placeholder="Username To Login Into">
          </div>
      </div>
          <!-- End Username Field -->
          <div class="col-sm-6">
					<div class="inputBox" style="color: black;">
						<div class="inputText" style="color: white;" >Colleges</div>
                        <select name="College_Name"  class="input" >
								<option value="0">...</option>
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


       } elseif ($do == 'insert') {     
                                //page insert

                              
                                if(isset($_POST['submit'])){
                                    echo "<h1 class='text-center'>Insert Item</h1>";
                                    echo "<div class='container'>";
                                    $name=mysqli_real_escape_string($conn,check_empty(check_input_admin($_POST["name_department"])));
                                    $descrip=mysqli_real_escape_string($conn,check_empty(check_input_admin($_POST["description"])));
                                    $college=mysqli_real_escape_string($conn,$_POST["College_Name"]);
                                    if(!empty($errors)){
                                                    $_SESSION['errors']=$errors;
                                                    redicrt('?do=Add');
                                                    }
                        
                                                    $check=checkitem('name_department','department',$name);
                                                    if($check==1){
                                                    $_SESSION['msg']=error_msg_add();
                                                                    
                                                    redicrt("?do=Add");
                        
                                                    }else{
                        
                        
                                                    $sql="INSERT INTO `department`(`name_department`, `description`, `college_id`) VALUES
                                                    ('{$name}','{$descrip}',{$college})";
                                                        
                                                            if (mysqli_query($conn, $sql) && mysqli_affected_rows($conn)>0) {
                                                            $_SESSION['msg']=secusse_msg_admin();
                                                            redicrt("?do=manage");
                                                            }else{
                                                                    $_SESSION['msg']=error_msg_admin();
                                                                    redicrt("?do=Add");
                                                                    
                                                                }
                        
                                                        }
                        
                        
                                                    }else{
                                                        $_SESSION['msg']=error_msg_admin();
                                                        redicrt("?do=manage");
                        
                                                    }  //end insert pagee
                        
                                                    
                        

 





                                                



       } elseif ($do == 'Edit') {

        $id = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
                                
                               
        $query="SELECT * FROM `department` WHERE id_department=$id"   ;
        $result=mysqli_query($conn,$query);
        $row=mysqli_fetch_assoc($result);
        if($result && mysqli_affected_rows($conn)>0)
    {
   
 
   ?>
   
<div class="formBox">
                                   
     <div class="row">
             <div class="col-sm-12">  <h1>College info</h1>  </div>
      </div>
      
   <form class="form-horizontal" action="?do=Update" method="POST">
   <input type="hidden" name="ID" value="<?php echo $id ?>" />
  <!-- Start Username Field -->
  <div class="row">
      <div class="col-sm-6">
          <div class="inputBox">
              <div class="inputText">name_department</div>
              <input type="text" class="input"   value="<?php echo $row['name_department'];?>"
              name="name_department" autocomplete="off" required="required" placeholder="Username To Login Into">
          </div>
      </div>
    
    
          <!-- End Username Field -->
          <div class="col-sm-6">
					<div class="inputBox" style="color: black;">
						<div class="inputText" style="color: white;" >Colleges</div>
                        <select name="College_Name"  class="input" >
								<option value="0">...</option>
                                <?php
                                 $query="SELECT `id_Colleges`, `name_Colleges` FROM `colleges` ";
                                 $result=mysqli_query($conn,$query);
                                 $row1=mysqli_fetch_all($result,MYSQLI_ASSOC);
                                 foreach ($row1 as $u){
                                    echo "<option value='" . $u['id_Colleges'] . "'";
                                    if ($row['college_id']== $u['id_Colleges']) 
                                    { 
                                        echo 'selected';
                                    
                                    }
                                    
                                    
                                    echo ">" . $u['name_Colleges'] . "</option>";
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
              <textarea  type="email" name="description" class="input"
              required="required"  autocomplete="off"placeholder="Email Must Be Valid"  rows="5"
              >
              <?php echo $row['description'];?>
              </textarea>
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


                            }










        //end add page


       } elseif ($do == 'Update') {

        echo msg(); 
        $errors=er(); 

        if(isset($_POST['submit'])){
            
            $id = $_POST['ID'];
            $name=mysqli_real_escape_string($conn,check_empty(check_input_admin($_POST["name_department"])));
            $descrip=mysqli_real_escape_string($conn,check_empty(check_input_admin($_POST["description"])));
            $college=mysqli_real_escape_string($conn,$_POST["College_Name"]);

              if(!empty($errors)){
                  $_SESSION['errors']=$errors;
                   redicrt('?do=manage');
                  }
                
                      

              $sql="UPDATE department  SET`name_department`='{$name}',`description`='{$descrip}',`college_id`='{$college}'
               WHERE id_department='{$id}'  ";

               if (mysqli_query($conn, $sql) && mysqli_affected_rows($conn)>0) {
                $_SESSION['msg']=secusse_msg_Edit();
                  redicrt("?do=manage");
               }else{
                   $_SESSION['msg']=error_msg_change();
                   redicrt('?do=manage');
                   
               }
           
}



       } elseif ($do == 'Delete') {
        echo "<h1 class='text-center'>Delete Member</h1>";
        echo "<div class='container'>";
    
            // Check If Get Request userid Is Numeric & Get The Integer Value Of It
    
            $id = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
    
            // Select All Data Depend On This ID
    
            
    
            // If There's Such ID Show The Form
             $check=checkItem('id_department','
             department',$id);
            if($check>0){
            $sql="DELETE FROM `department` WHERE id_department={$id} LIMIT 1";
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

   

   

  
?>
<?php
ob_end_flush(); // Release The Output
include $tpl.'footer.php';
?>
