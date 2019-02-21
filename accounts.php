<?php
$pageTitle='account';
include 'init.php';


check_login_employe();
?>
<?php
global $college;
$college=$_SESSION['college'];
$namecollege=fetch('name_Colleges','colleges',$college);
foreach ($namecollege as $coll){


 $do = isset($_GET['do']) ? $_GET['do'] : 'viwe';
 if($do=='viwe'){
    
    ?>
        <div class="formBox">
        <div class="row">
                     <div class="col-sm-12">
                         <br>
                         <br>
                         <h1> الحسابات <?php echo $coll['name_Colleges'] ?></h1>
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
            INNER JOIN department ON department.id_department=student.id_college
            WHERE(student.id_college=$college)
            ";



             $result=mysqli_query($conn,$query);
             if(mysqli_num_rows($result)>0)
             {
    
    
    
    
          ?>
        <div class="container">
        <hr style="border-top: 3px solid rgb(241, 25, 25)";>
        <div class="row">
            <div class="panel panel-primary filterable">
                <div class="panel-heading">
                    <h3 class="panel-title">Student info</h3>
                    <div class="pull-right">
                        <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                    </div>
                </div>
                <table
                class="main-table text-center table table-bordered"
                style="background-color:#214860; color:#fff;"
               
                                       >
                    <thead>
                        <tr class="filters" style="background-color:#214860; color:#fff;">
                            <th>#ID</th>
                            <th><input type="text" class="form-control" placeholder="First Name" disabled></th>
                            <th><input type="text" class="form-control" placeholder="lastName" disabled></th>
                            <th><input type="text" class="form-control" placeholder="department" disabled></th>
                            <th><input type="text" class="form-control" placeholder="status" disabled></th>
                            <th><input type="text" class="form-control" placeholder="phase" disabled></th>
                            <th>patent</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                            while($row=mysqli_fetch_assoc($result)){
    
    
                                echo "<tr>";
                                echo "<td>" . $row['student_id'] . "</td>";
                                echo "<td>" . $row['frist_name'] . "</td>";
                                echo "<td>" . $row['last_name'] . "</td>";
                                echo "<td>" . $row['department'] ."</td>";
                                echo "<td>" . $row['status'] . "</td>";
                                echo "<td>" . $row['phase'] ."</td>";
                                    if ($row['account'] == 0) {
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
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
     }elseif($do=='Approve')
    {
        echo "<h1 class='text-center'>Activate Member</h1>";
        echo "<div class='container'>";
    
            // Check If Get Request userid Is Numeric & Get The Integer Value Of It
    
            $student = isset($_GET['student_id']) && is_numeric($_GET['student_id']) ? intval($_GET['student_id']) : 0;
    
            // Select All Data Depend On This ID
    
                $check=checkItem('student_id','student',$student);
                if($check>0){
                $sql="UPDATE  `student` SET `account`=1  WHERE student_id={$student} LIMIT 1";
                    $result=mysqli_query($conn,$sql);
                        if ( $result && mysqli_affected_rows($conn)>0) {
                                
                                
                            $_SESSION['msg']=secusse_msg_palent();
                            redicrt("?do=viwe");
                                
                            }else{
                                
                                $_SESSION['msg']= error_msg_palent();
                                redicrt("?do=viwe");
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
                $sql="UPDATE  `student` SET `account`=0  WHERE student_id={$student} LIMIT 1";
                    $result=mysqli_query($conn,$sql);
                        if ( $result && mysqli_affected_rows($conn)>0) {
                                
                                
                            $_SESSION['msg']=secusse_msg_palent();
                            redicrt("?do=viwe");
                                
                            }else{
                                
                                $_SESSION['msg']= error_msg_palent();
                                redicrt("?do=viwe");
                                }
                    
    
    
    
                }					
    
    
            
    
    
    
    }
    ?>
   
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    <?php
    
    
    
    }
    include $tpl  .'footer.php';
    ?>
