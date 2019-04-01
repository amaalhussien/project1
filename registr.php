<?php
$pageTitle='registrition';

$noNavbar='  ';
include 'init.php';
check_login_employe();
?>
<div class="asd">
<?php
global $college;
$college=$_SESSION['college'];
$namecollege=fetch('name_Colleges','colleges',$college);
foreach ($namecollege as $coll){


 $do = isset($_GET['do']) ? $_GET['do'] : 'manage';
 if($do=='manage'){ 
    if($_SESSION['level']==1){
    ?>

    <div class="formBox"style="padding:120px;" >
       
    <div class="row">
                 <div class="col-sm-12">
                     <h1> شعبة التسجيل <?php echo $coll['name_Colleges'] ?></h1>
                     <?php echo msg(); ?>
                                 <?php $errors=er(); ?>
                                   <?php errors_function($errors);
                        ?>
                 </div>
           </div>
    <div class="home-stats">
          <div class="container text-center">
             
              <div class="row">
              <div class="col-md-2">
            </div>
              <div class="col-md-4">
                      <div class="stat st-members">
                          <i class="fa fa-user-plus"></i>
                          <div class="info">
                            Total student /add student
                              <span>
                                  <a href="?do=add"><?php
                                  echo countItems('student',$college);
                                  
                                  
                                  ?> </a>
                              </span>
                          </div>
                      </div>
                  </div>

                  <div class="col-md-4">
                      <div class="stat st-pending">
                          <i class="fa fa-graduation-cap"></i>
                          <div class="info">
                             Total student/show student info
                              <span>
                                <a href="?do=viwe"><?php echo countItems('student',$college) ?></a>
                                      
                                  </a>
                              </span>
                          </div>
                      </div>
                  </div>

             </div>
        </div>
   </div>
   </div>
   <?php

    }else{
        redicrt('index.php');
        
    }

 }elseif($do=='add')
 {
    if($_SESSION['level']==1){
    
    ?>
<div class="formBox">
    <div class="row">
                 <div class="col-sm-12">
                     <h1> شعبة التسجيل <?php echo $coll['name_Colleges'] ?></h1>
                     <?php echo msg(); ?>
                                 <?php $errors=er(); ?>
                                   <?php errors_function($errors);
                              ?>
                 </div>
             </div>
    <div class="container">
         <div class="row">
                  <div class="col-sm-12">
                      <h1>Add Student</h1>	
                      <h2>Add Excel that contains student names </h2>		
             </div>
          </div>
             <div class="site-info">
               <form class="form-horizontal" action="?do=insert" method="post"
                         name="frmCSVImport" id="frmCSVImport" enctype="multipart/form-data">
                            <div class="inputBox">
 
                                     <div>
                                     <div class="inputText" style="color: white;" >file INFO</div>
                                   <input type="file" name="file" class="input"
                                                               id="file" accept=".xls,.xlsx">
                                  </div>
                                 
                              </div>
 
                            
                                 <div class="inputBox" style="color: black;">
                                     <div class="inputText" style="color: white;" >department</div>
                                       <select name="department"  class="input" >
                                         <option value="0">select department</option>
                                 <?php
                                       $query="SELECT `id_department`,`college_id`, `name_department` FROM `department`
                                              WHERE college_id=$college";
                                                  $result=mysqli_query($conn,$query);
                                                    $row=mysqli_fetch_all($result,MYSQLI_ASSOC);
                                                      foreach ($row as $u){
                                                  echo "<option value='" . $u['id_department'] . "'>" . $u['name_department'] . "</option>";
                                                   }
                                 ?>
                                          </select>
                                     </div>
                              
 
 
            
                     <div class="inputBox" style="color: black;">
                         <div class="inputText" style="color: white;" >type</div>
                         <select name="status" class="input">
                                 <option value="0"></option>
                                 <option value="صباحي">صباحي</option>
                                 <option value="مسائي">مسائي</option>
                             </select>
                       
                     </div>
                  
                              
                             <input type="submit" value="improt" class="btn btn-lg btn-block login_btn" name="import" 
                                style="margin-top: 30px;margin-bottom: 23px;" >
                                
                                
                 
                               </div>
                                 
                            </div>     
                    </form>
 </div>
     


</div>
                                               

<?php

      }else{
          redicrt('index.php');
      }

 }elseif($do=='insert'){
   
    require_once('inc/Libraries/vendor/php-excel-reader/excel_reader2.php');
    require_once('inc/Libraries/vendor/SpreadsheetReader.php');

if (isset($_POST["import"]))
{
    
                    
 $department=$_POST["department"];
 $stauts=$_POST["status"];
  $allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
  
  if(in_array($_FILES["file"]["type"],$allowedFileType)){

        $targetPath = 'uploads/'.$_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);
        
        $Reader = new SpreadsheetReader($targetPath);
        
        $sheetCount = count($Reader->sheets());
        for($i=0;$i<$sheetCount;$i++)
        {
            
            $Reader->ChangeSheet($i);
            
            foreach ($Reader as $Row)
            {
          
                $fristname = "";
                if(isset($Row[0])) {
                    $fristname = mysqli_real_escape_string($conn,$Row[0]);
                }
                $phase = "";
                if(isset($Row[1])) {
                    $phase = mysqli_real_escape_string($conn,$Row[1]);
                }
                $section = "";
                if(isset($Row[2])) {
                    $section = mysqli_real_escape_string($conn,$Row[2]);
                }
              

                if (!empty($fristname)||!empty($lastname)||!empty($phase)||!empty($section)) {
                      if($section=='نعم'){
                          $section1=1;
                      }else{
                          $section1=0;
                      }

                    $query = "insert into student(`name_student`,`Internal_section`,`phase`,
                    `id_department`,`id_college`,`status`)  VALUES
                    ('{$fristname}','{$section1}','{$phase}','{$department}','{$college}','{$stauts}'
                    )";
                    $result = mysqli_query($conn, $query);
                
                    if (! empty($result)) {
                       
                    } else {
                    
                    }
                }
             }

        
        }redicrt('?do=manage');
  }
  else
  { 
       redicrt('do=manage');
  }
}


 }elseif($do=='viwe'){
    if($_SESSION['level']==1){
    
?>
     
    <div class="formBox">
    <div class="row">
                 <div class="col-sm-12">
                     <br>
                     <br>
                     <h1> شعبة التسجيل <?php echo $coll['name_Colleges'] ?></h1>
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
       WHERE(student.id_college=$college)
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
                        <td>college</th>
                        <th>department</th>
                        <th>status</th>
                        <th>phase</th>
                        <th>control</th>
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
                            echo "<td>
                                <a href='?do=Delete&student_id=".$row['student_id']. "' class='btn btn-danger confirm s><i class='fa fa-close'></i> Delete </a>
                                
                                </td>";
                                
                                if ($row['registertion'] == 0) {
                            echo "<td> <a href='?do=Approve&student_id=".$row['student_id'] . "' class='btn btn-info' ><i class='fa fa-check'></i></a></td>";
                                }else{
                                    echo "<td> <a href='?do=notApprove&student_id=".$row['student_id'] . "' class='btn btn-danger' ><i class='fa fa-times' aria-hidden='true'></i></a>";
                                }
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
            $sql="UPDATE  `student` SET `registertion`=1  WHERE student_id={$student} LIMIT 1";
                $result=mysqli_query($conn,$sql);
                    if ( $result && mysqli_affected_rows($conn)>0) {
                            
                            
                        redirectHome('back');
                            
                        }else{
                            
                            
                            redirectHome('back');
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
            $sql="UPDATE  `student` SET `registertion`=0  WHERE student_id={$student} LIMIT 1";
                $result=mysqli_query($conn,$sql);
                    if ( $result && mysqli_affected_rows($conn)>0) {
                            
                            
                        redirectHome('back');
                            
                        }else{
                            
                            redirectHome('back');
                           
                        }
                



            }					


        



}elseif ($do == 'Delete') { // Delete Member Page

    echo "<h1 class='text-center'>Delete Member</h1>";
    echo "<div class='container'>";

        // Check If Get Request userid Is Numeric & Get The Integer Value Of It

       

        // Select All Data Depend On This ID

        
        // If There's Such ID Show The Form
        $student = isset($_GET['student_id']) && is_numeric($_GET['student_id']) ? intval($_GET['student_id']) : 0;

        // Select All Data Depend On This ID

         $check=checkItem('student_id','student',$student);
        if($check>0){
      
       
        $sql="DELETE FROM `student` WHERE student_id={$student} LIMIT 1";
            $result=mysqli_query($conn,$sql);
                if ( $result && mysqli_affected_rows($conn)>0) {
                        
                        
                    $_SESSION['msg']=secusse_msg_delete();
                    redicrt("?do=viwe");
                        
                    }else{
                        
                        $_SESSION['msg']= error_msg_delete();
                        redicrt("?do=viwe");
                        }
            



        }	
    }				


    



































































?>
</div>
</div>
</div>
<?php



}

include $tpl  .'footer.php';
?>