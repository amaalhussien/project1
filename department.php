<?php
$pageTitle='department';
$noNavbar=' ';
include 'init.php';
check_login_employe();
global $college;
global $department;
$department=$_SESSION['department'];
$college=$_SESSION['college'];
$namecollege=fetch('name_Colleges','colleges',$college);



 $do = isset($_GET['do']) ? $_GET['do'] : 'manage';
 if($do=='manage'){ 
   ?>
   <div class="asd">
    <div class="formBox">
    <div class="row">
                 <div class="col-sm-12">
                 <?php foreach ($namecollege as $coll){ ?>
                     <h1>  <?php echo $coll['name_Colleges'];  }?></h1>
                    <?php 
                    $namedepartment=fetchd('name_department','department',$department);
                    foreach($namedepartment as $depar){?>

                     <h2 style="text-align:center;margin-bottom: -10px;"> <?php echo $depar['name_department']; }?> </h2>
                     <?php echo msg(); ?>
                                 <?php $errors=er(); ?>
                                   <?php errors_function($errors);
                        ?>
                 </div>
           </div>
                  
         </div>
       <?php
      $query="SELECT student.*, 
      colleges.name_Colleges AS College_Name, 
        department.name_department AS department 
            FROM student
         INNER JOIN colleges ON colleges.id_Colleges=student.id_college 
        INNER JOIN department ON department.id_department=student.id_college
        WHERE(student.id_college=$college AND student.id_department=$department)
        ";
         $result=mysqli_query($conn,$query);
         if(mysqli_num_rows($result)>0)
         {




      ?>
    <div class="container">
    <input type="button" onclick="tableToExcel('example', 'W3C Example Table')" value="Export to Excel">
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
                    <tr class="filters" style="background-color:#214860; color:#fff;">
                        <th>#ID</th>
                        <th>Name_Student</th>
                        <th>status</th>
                        <th>phase</th>
                        <th>registertion</th>
                        <th>account</th>
                    
                        <th>sport_unit</th>
                        <th>Internal_section</th>
                        <th>free_education</th>
                        <th>college_library</th>
                        <th>central_library</th> 
                      

                        
                     
                       
                    </tr>
                </thead>
                <tbody>
                <?php 
						while($row=mysqli_fetch_assoc($result)){


                            echo "<tr>";
                            echo "<td>" . $row['student_id'] . "</td>";
                            echo "<td>" . $row['name_student'] . "</td>";
                            echo "<td>" . $row['status'] . "</td>";
                            echo "<td>" . $row['phase'] ."</td>";
                            
                            if ($row['registertion'] == 0) {
                                echo "<td><i class='fa fa-times' aria-hidden='true'>NO</i></td>";
                                }else{
                                    echo "<td><i class='fa fa-check' aria-hidden='true'>Yes</i></td>";
                                }

                                    if ($row['account'] == 0) {
                                        echo "<td><i class='fa fa-times' aria-hidden='true'>NO</i></td>";
                                        }else{
                                            echo "<td><i class='fa fa-check' aria-hidden='true'>Yes</i></td>";
                                        } 
                                        
                                        
                                        if ($row['sport_unit'] == 0) {
                                            echo "<td><i class='fa fa-times' aria-hidden='true'>NO</i></td>";
                                            }else{
                                                echo "<td><i class='fa fa-check' aria-hidden='true'>Yes</i></td>";
                                            }

                                        if ($row['Internal_section'] == 0) {
                                            echo "<td><i class='fa fa-times' aria-hidden='true'>NO</i></td>";
                                            }else{
                                                echo "<td><i class='fa fa-check' aria-hidden='true'>Yes</i></td>";
                                            }        



                                            if ($row['free_education'] == 0) {
                                                echo "<td><i class='fa fa-times' aria-hidden='true'>NO</i></td>";
                                                }else{
                                                    echo "<td><i class='fa fa-check' aria-hidden='true'>Yes</i></td>";
                                                }        




                                                if ($row['college_library'] == 0) {
                                                    echo "<td><i class='fa fa-times' aria-hidden='true'>NO</i></td>";
                                                    }else{
                                                        echo "<td><i class='fa fa-check' aria-hidden='true'>Yes</i></td>";
                                                    }        






                                                    if ($row['central_library'] == 0) {
                                                        echo "<td><i class='fa fa-times' aria-hidden='true'>NO</i></td>";
                                                        }else{
                                                            echo "<td><i class='fa fa-check' aria-hidden='true'>Yes</i></td>";
                                                        }        
                               
                                      
                           
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
  
 
 
 
<script>
    var tableToExcel = (function() {
  var uri = 'data:application/vnd.ms-excel;base64,'
    , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
    , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
    , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
  return function(table, name) {
    if (!table.nodeType) table = document.getElementById(table)
    var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
    window.location.href = uri + base64(format(template, ctx))
  }
})()
    </script>








<?php
 }?>
  </div>
  </div>
  </div>
  </div>
        <?php
        
        include $tpl  .'footer.php';
        ?>