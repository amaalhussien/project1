<?php
$pageTitle='Internal_section';
$noNavbar=' ';
include 'init.php';
check_login_employe();
?>
<div class="asd">
<?php

 $do = isset($_GET['do']) ? $_GET['do'] : 'manage';
 if($do=='manage'){ 
    if($_SESSION['level']==8){
    ?>
   
    <div class="formBox" style="margin-top: 40px;">
        <div class="row">
                     <div class="col-sm-12">
                         <h1> الاقسام الداخلية / جامعة واسط</h1>
                         <?php echo msg(); ?>
                                     <?php $errors=er(); ?>
                                       <?php errors_function($errors);
                                  ?>
                     </div>
                 </div>
    

        <div class="container">
         <div class="row">
                
          </div>
             <div class="site-info">
 
               <form class="form-horizontal" action="?do=viwe" method="post"
                         name="frmCSVImport" id="frmCSVImport" enctype="multipart/form-data">
                                    <!--college start -->
                                    <div class="inputBox" style="color: black;">
                                     <div class="inputText">Colleges</div>
                                       <select name="college"  class="input" >
                                         <option value="0"></option>
                                 <?php
                                    
                                        $query="SELECT `id_Colleges`, `name_Colleges` FROM `colleges` ";
                                        $result=mysqli_query($conn,$query);
                                        $row=mysqli_fetch_all($result,MYSQLI_ASSOC);
                                        foreach ($row as $co){
                                           echo "<option value='" . $co['id_Colleges'] . "'>" . $co['name_Colleges'] . "</option>";
                                        }
                                       ?>
                                          </select>
                                     </div>


                                     <div class="inputBox" style="color: black;">
                                        <div class="inputText">department</div>
                                       <select name="department"  class="input" >
                                         <option value="0"></option>
                                 
                                       <?php
                                       $query="SELECT `id_department`, `name_department` FROM `department`";
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
</div>  
                                      
















<?php
    }else{
        redicrt('index.php');
    }
 }elseif($do=='viwe'){
    if($_SESSION['level']==8){
    
    if(isset($_POST['import'])){
           
               $college=$_POST["college"];
               $department=$_POST["department"];

              $_SESSION['dep']=$department;
              $_SESSION['col']=$college;
              
             }

           $dep=$_SESSION['dep'];
           $col=$_SESSION['col'];
        
              
?> 

   
    
        <div class="formBox">
        <div class="row">
                     <div class="col-sm-12">
                         <br>
                         <br>
                         <h1>الاقسام الداخلية / جامعة واسط </h1>
                         <?php echo msg(); ?>
                                     <?php $errors=er(); ?>
                                       <?php errors_function($errors);
                                  ?>
                     </div>
                 </div>
    
           <?php
          $query="SELECT student.*, 
          colleges.name_Colleges AS College_Name, 
            department.name_department AS department 
                FROM student
             INNER JOIN colleges ON colleges.id_Colleges=student.id_college 
            INNER JOIN department ON department.id_department=student.id_department
            WHERE(student.id_college=$col AND student.id_department=$dep AND student.Internal_section=1 )
            ";



             $result=mysqli_query($conn,$query);
             if(mysqli_num_rows($result)>0)
             {
    
    
    
    
          ?>
       <div class="container">
         <hr style="border-top: 3px solid rgb(241, 25, 25)";>
          <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>عرض الطلاب</h5>
                    </div>
      <div class="ibox-content">
                    <table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%;
                             background-color:#214860; color:#fff;">
                             <thead>
                <tr class="filters" style="background-color: #f3f1f1;
                                           color: #131212;">
                        <th>#ID</th>
                        <th>name student</th>
                        <th>name_College</th>
                        <th>department</th>
                        <th>status</th>
                        <th>phase</th>
                        <th>patent</th>
                    </tr>
                </thead>
                <tbody>
                       
                    <?php 
                            while($row=mysqli_fetch_assoc($result)){
    
    
                                echo "<tr>";
                                echo "<td>" . $row['student_id'] . "</td>";
                                echo "<td>" . $row['name_student'] . "</td>";
                                echo "<td>" . $row['College_Name'] ."</td>";
                                echo "<td>" . $row['department'] ."</td>";
                                echo "<td>" . $row['status'] . "</td>";
                                echo "<td>" . $row['phase'] ."</td>";
                              
                                
                             echo "<td>";  
                              echo "<a href='?do=Approve&student_id=".$row['student_id'] . "' class='btn btn-info' ><i class='fa fa-check'></i></a>";
                            echo "</td>";
                            echo "</tr>";
                        }
    
    
                    }
                    ?>
                     
                     
                     
                     
                     
                     
                     
                     
                     
                     
                    </tbody>
                </table>
            </div>
        </div>
    </div>
     </div>
  
                </div>


<?php
    }else{
        redicrt('index.php');
    }

}elseif($do=='Approve')
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
                            
                            
                        //$_SESSION['msg']=secusse_msg_palent();
                        redirectHome('back');      
                        }else{
                            
                          //  $_SESSION['msg']= error_msg_palent();
                            redirectHome('back');
                            }
                



            }					


        



}
?>

















</div>
</div>
</div>

<?php





 ?>
 </div>

 <?php
 include $tpl  .'footer.php';
 ?>
                                               

     