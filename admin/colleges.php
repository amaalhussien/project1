<?php
/*
manage admin
Edit /delete /add /

*/
ob_start(); // Output Buffering Start


$pageTitle='colleges manage';


include 'init.php';
check_login();


$do = isset($_GET['do']) ? $_GET['do'] : 'manage';
if($do=='manage'){

    $query="SELECT `id_Colleges`, `name_Colleges`, `description` FROM `colleges` ";
    $result=mysqli_query($conn,$query);
    if(mysqli_num_rows($result)>0)
    {
        ?>
        <div class="formBox">
        <h1 class="text-center">Management of colleges </h1>
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
                   <td>description</td>
                   <td>Control</td>
               </tr>
               <?php 
               while($row=mysqli_fetch_assoc($result)){
               
                       echo "<tr>";
                           echo "<td>" . $row['id_Colleges'] . "</td>";
                           echo "<td>" . $row['name_Colleges'] . "</td>";
                           echo "<td>" . $row['description'] . "</td>";
                           echo "<td>
                               <a href='colleges.php?do=Edit&id_Colleges=".$row['id_Colleges'] ."' class='btn btn-success' ><i class='fa fa-edit'></i> Edit</a>
                               <a href='colleges.php?do=Delete&id_Colleges=" . $row['id_Colleges'] . "' 
                               class='btn btn-danger confirm s><i class='fa fa-close'></i> Delete </a>";
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

   <?php } else {

                echo '<div class="container">';
               echo '<div class="nice-message">There\'s No Members To Show</div>';
               echo '<a href="colleges.php?do=Add" class="btn btn-primary">
               <i class="fa fa-plus"></i> New Member
                    </a>';
                   echo '</div>';

} ?>

   




<?php 
      






}elseif ($do == 'Delete') { // Delete Member Page

    echo "<h1 class='text-center'>Delete Member</h1>";
    echo "<div class='container'>";

        // Check If Get Request userid Is Numeric & Get The Integer Value Of It

        $id = isset($_GET['id_Colleges']) && is_numeric($_GET['id_Colleges']) ? intval($_GET['id_Colleges']) : 0;

        // Select All Data Depend On This ID

        

        // If There's Such ID Show The Form
         $check=checkItem('id_Colleges','colleges',$id);
        if($check>0){
        $sql="DELETE FROM `colleges` WHERE id_Colleges={$id} LIMIT 1";
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
            </div>
                <!-- End Username Field -->
                 <!-- Start Password Field -->
            
         
        <div class="row">
            <div class="col-sm-12">
                <div class="inputBox">
                    <div class="inputText"> description</div>
                    <textarea  type="email" name="description" class="input"   required="required"  autocomplete="off"placeholder="description college"  rows="5"
                    
                    style= "margin: 0px; height: 100px"></textarea>
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
}


elseif($do=='insert'){ //insert page

            if(isset($_POST['submit'])){
            $name=mysqli_real_escape_string($conn,check_empty(check_input_admin($_POST["name_colleges"])));
            $descrip=mysqli_real_escape_string($conn,check_empty(check_input_admin($_POST["description"])));
           
                            if(!empty($errors)){
                            $_SESSION['errors']=$errors;
                            redicrt('?do=Add');
                            }

                            $check=checkitem('name_Colleges','colleges',$name);
                            if($check==1){
                            $_SESSION['msg']=error_msg_add();
                                            
                            redicrt("?do=Add");

                            }else{


                            $sql="INSERT INTO `colleges`(`name_Colleges`,`description`) VALUES
                            ('{$name}','{$descrip}')";
                                
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

                            }

                            elseif($do=='Edit'){
                                // Check If Get Request userid Is Numeric & Get Its Integer Value
                       
                                $id = isset($_GET['id_Colleges']) && is_numeric($_GET['id_Colleges']) ? intval($_GET['id_Colleges']) : 0;
                                
                               
                                $query="SELECT * FROM `colleges` WHERE id_Colleges=$id    LIMIT 1 "   ;
                                $result=mysqli_query($conn,$query);
                                $row=mysqli_fetch_assoc($result);
                                if($result && mysqli_affected_rows($conn)>0)
                            {
                           
                         
                           ?>
                           
                             
                                      <div class="formBox">
                                   
                                               <div class="row">
                                                   <div class="col-sm-12">
                                                       <h1>College info</h1>
                                                       
                                                   </div>
                                               </div>
                                   
                                               <form class="form-horizontal" action="?do=Update" method="POST">
                                               <input type="hidden" name="ID" value="<?php echo $id ?>" />
                                               <!-- Start Name Field -->
                                               <div class="row">
                                                   <div class="col-sm-6">
                                                       <div class="inputBox">
                                                           <div class="inputText"> Name College</div>
                                                           <input type="text" class="input"  
                                                           name="name" autocomplete="off"
                                                            value="<?php echo $row['name_Colleges'] ?>" required="required" >
                                                       </div>
                                                   </div>  
                                               </div>
                                                <!-- End Name Field -->
                                               <div class="row">
                                                   <div class="col-sm-12">
                                                       <div class="inputBox">
                                                       <div class="inputText"> description</div>
                                                          <textarea  type="text" name="description" class="input"  
                                                             required="required"  autocomplete="off"  rows="5" >
                                                             <?php echo $row['description'] ?>
                                                             </textarea>
                                                           
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
                       
                       }                 




                       elseif ($do == 'Update') { // Update Page

                        echo "<h1 class='text-center'>Update Member</h1>";
                        echo "<div class='container'>";
                        echo msg(); 
                        $errors=er(); 
           
                        if(isset($_POST['submit'])){
                            
                            $id = $_POST['ID'];
                            $name=mysqli_real_escape_string($conn,check_empty(check_input_admin($_POST["name"])));
                            $descrip=mysqli_real_escape_string($conn,check_empty(check_input_admin($_POST["description"])));
                           
                            

                              if(!empty($errors)){
                                  $_SESSION['errors']=$errors;
                                   redicrt('?do=manage');
                                  }
                                
                                      

                              $sql="UPDATE colleges  SET`name_Colleges`='{$name}',`description`='{$descrip}'
                               WHERE id_Colleges='{$id}'  ";
        
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
    ob_end_flush(); // Release The Output
    include $tpl.'footer.php';
    ?>
    