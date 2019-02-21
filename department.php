<?php
$pageTitle='department';
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
    <div class="formBox">
    <div class="row">
                 <div class="col-sm-12">
                 <?php foreach ($namecollege as $coll){ ?>
                     <h1>  <?php echo $coll['name_Colleges'];  }?></h1>
                    <?php 
                    $namedepartment=fetchd('name_department','department',$department);
                    foreach($namedepartment as $depar){?>

                     <h1> <?php echo $depar['name_department']; }?> </h1>
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
        WHERE(student.id_college=$college AND student.id_department=$department)
        ";
         $result=mysqli_query($conn,$query);
         if(mysqli_num_rows($result)>0)
         {




      ?>
    <div class="container">
    <input type="button" onclick="tableToExcel('testTable', 'W3C Example Table')" value="Export to Excel">
    <hr style="border-top: 3px solid rgb(241, 25, 25)";>
    <div class="row">
        <div class="panel panel-primary filterable">
            <div class="panel-heading">
                <h3 class="panel-title">Student info</h3>
                <div class="pull-right">
                    <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                </div>
            </div>
            <table id="testTable"
            class="main-table text-center table table-bordered"
            style="background-color:#214860; color:#fff;"
            >
                <thead>
                    <tr class="filters" style="background-color:#214860; color:#fff;">
                        <th>#ID</th>
                        <th><input type="text" class="form-control" placeholder="First Name" disabled></th>
                        <th><input type="text" class="form-control" placeholder="lastName" disabled></th>
                        <th><input type="text" class="form-control" placeholder="status" disabled></th>
                        <th><input type="text" class="form-control" placeholder="phase" disabled></th>
                      <td>registertion</td>
                      <td>account</td>
                      <td>sport_unit</td>
                      <td>Internal_section</td>
                       
                    </tr>
                </thead>
                <tbody>
                <?php 
						while($row=mysqli_fetch_assoc($result)){


                            echo "<tr>";
                            echo "<td>" . $row['student_id'] . "</td>";
                            echo "<td>" . $row['frist_name'] . "</td>";
                            echo "<td>" . $row['last_name'] . "</td>";
                            echo "<td>" . $row['status'] . "</td>";
                            echo "<td>" . $row['phase'] ."</td>";
          
                                if ($row['registertion'] == 0) {
                                echo "<td>NO</td>";
                                }else{
                                    echo "<td>yes</td>";
                                }
                                if ($row['account'] == 0) {
                                  echo "<td>NO</td>";
                                  }else{
                                      echo "<td>yes</td>";
                                  }
                                  if ($row['sport_unit'] == 0) {
                                    echo "<td>NO</td>";
                                    }else{
                                        echo "<td>yes</td>";
                                    }
                                    if ($row['Internal_section'] == 0) {
                                      echo "<td>NO</td>";
                                      }else{
                                          echo "<td>yes</td>";
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
        <?php
        include $tpl  .'footer.php';
        ?>