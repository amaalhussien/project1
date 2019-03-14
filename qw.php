<?php
$pageTitle='Internal_section';

include 'init.php';
?>
<?php
 $do = isset($_GET['do']) ? $_GET['do'] : 'manage';
 if($do=='manage'){ 
    ?>
    <div class="formBox">
        <div class="row">
                     <div class="col-sm-12">
                         <h1> الاقسام الداخليه جامعة واسط</h1>
                         <?php echo msg(); ?>
                                     <?php $errors=er(); ?>
                                       <?php errors_function($errors);
                                  ?>
                     </div>
                 </div>
    

        <div class="container">
         <div class="row">
                  <div class="col-sm-12">
                      <h1> Student info</h1>			
             </div>
          </div>
             <div class="site-info">
 
               <form class="form-horizontal" action="?do=viwe" method="post"
                         name="frmCSVImport" id="frmCSVImport" enctype="multipart/form-data">
                                    <!--college start -->
                                    <div class="inputBox" style="color: black;">
                                     <div class="inputText" style="color: white;" >Colleges</div>
                                       <select name="college"  class="input" >
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
                              
                               <input type="submit" value="search" class="btn btn-lg btn-block login_btn" name="import" 
                                style="margin-top: 30px;margin-bottom: 23px;" >
                                
                                
                 
                               </div>
                                 
                            </div>     
                    </form>
 </div>
     


</div>
                                      
















<?php
 }elseif($do=='viwe'){

    ?>
    <div class="formBox">
    <div class="row">
                 <div class="col-sm-12">
                     <h1> الاقسام الداخليه جامعة واسط</h1>
                     <?php echo msg(); ?>
                                 <?php $errors=er(); ?>
                                   <?php errors_function($errors);
                              ?>
                 </div>
             </div>

<?php
             if(isset($_POST['import'])){
					
						$college=$_POST["college"];
                        $department=$_POST["department"];

                       $_SESSION['dep']=$department;
                       $_SESSION['col']=$college;
                       
                      
                         
                       

                    }

                    $dep=$_SESSION['dep'];
                    $col=$_SESSION['col'];

                        $sql="SELECT * FROM student WHERE `id_department`=$dep
                         AND`id_college`=$col ";
					   $result=mysqli_query($conn,$sql);
                       if(mysqli_num_rows($result)>0)
                       {
   ?>

              <div class="container">
				<div class="table-responsive">
					<table class="main-table text-center table table-bordered" 
                    style="background-color:#214860; color:#fff;"
                    
                    >
						<tr>
							<td>#ID</td>
							<td>fristname</td>
							<td>lastname</td>
							<td>Control</td>
						</tr>
						<?php 
						while($row=mysqli_fetch_assoc($result)){
                            echo "<tr>";
                            echo "<td>" . $row['student_id'] . "</td>";
                            echo "<td>" . $row['frist_name'] . "</td>";
                            echo "<td>" . $row['last_name'] . "</td>";
                            if ($row['Internal_section'] == 0) {
                                echo "<td> <a href='?do=Approve&student_id=".$row['student_id'] . "' class='btn btn-info' ><i class='fa fa-check'></i></a></td>";
                                    }else{
                                        echo "<td> <a href='?do=notApprove&student_id=".$row['student_id'] . "' class='btn btn-danger' ><i class='fa fa-times' aria-hidden='true'></i></a>";
                                    }
                                echo "</td>";
                            echo "</tr>";
                        }
                    }
    
                        ?>
                        <?php
                              ?>
                            
                        </table>
                        </div>
                    
                     
                     
                     
                     
                     
                     
                                
                            





















     <?php
  }elseif($do=='Approve')
 {
     echo "<h1 class='text-center'>Activate Member</h1>";
     echo "<div class='container'>";
 
         // Check If Get Request userid Is Numeric & Get The Integer Value Of It
 
         $student = isset($_GET['student_id']) && is_numeric($_GET['student_id']) ? intval($_GET['student_id']) : 0;
 
         // Select All Data Depend On This ID
 
             $check=checkItem('student_id','student',$student);
             if($check>0){
             $sql="UPDATE  `student` SET `Internal_section`=1  WHERE student_id={$student} LIMIT 1";
                 $result=mysqli_query($conn,$sql);
                     if ( $result && mysqli_affected_rows($conn)>0) {
                             
                             
                         $_SESSION['msg']=secusse_msg_palent();
                         redirectHome($theMsg, 'back');
                             
                         }else{
                             
                             $_SESSION['msg']= error_msg_palent();
                             redirectHome($theMsg, 'back');
                             }
                 
 
 
 
             }					
 
 
         
 
 
 
 }elseif($do=='notApprove')
 {
     echo "<h1 class='text-center'>Activate Member</h1>";
     echo "<div class='container'>";
 
         // Check If Get Request userid Is Numeric & Get The Integer Value Of It
 
         $student = isset($_GET['student_id']) && is_numeric($_GET['student_id']) ? intval($_GET['student_id']) : 0;
 
         // Select All Data Depend On This ID
 
             $check=checkItem('student_id','student',$student);
             if($check>0){
             $sql="UPDATE  `student` SET `Internal_section`=0  WHERE student_id={$student} LIMIT 1";
                 $result=mysqli_query($conn,$sql);
                     if ( $result && mysqli_affected_rows($conn)>0) {
                             
                             
                         $_SESSION['msg']=secusse_msg_palent();
                         redirectHome($theMsg, 'back');
                             
                         }else{
                             
                             $_SESSION['msg']= error_msg_palent();
                             redirectHome($theMsg, 'back');
                             }
                 
 
 
 
             }					
 
 
            }
 
 
 
 ?>

 <?php
 include $tpl  .'footer.php';
 ?>
                                               

     