<!-- start upper bar -->
<div class="upper-bar">
      <div class="container">
        <div class="row">
          <div class="info col-sm text-center text-sm-left">
            <i class="fa fa-phone"></i> <span>04543332</span>,
            <i class="fa fa-envelope-o"></i> amaalhussien9090@gmail.com
          </div>
      
          </div>
        </div>
      </div>
 <!--end upper bar -->
 <!--navbar start -->
 <nav class="navbar navbar-expand navbar-light">
      <div class="container">
        <a class="navbar-brand" href="#">
          <span>Universit</span><span>of Wasit</span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-nav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="main-nav">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
           
            <?php

if(isset($_SESSION['user_name']))
{?>
  <div class="btn-group my-info">
  <span class="btn btn-default dropdown-toggle" data-toggle="dropdown" style="background-color: #224a63;">
  <?php echo $_SESSION['user_name'] ?>
  <span class="caret"></span>
</span>
<ul class="dropdown-menu"  style="background-color: #FFF; color:#000;">
<?php
             if($_SESSION['level']==1)
              {
               echo'<li><a href="registr.php">Division registration</a></li>';
              }elseif($_SESSION['level']==2)
              {
              echo'<li><a href="accounts.php">Accounts</a></li>';
              } elseif($_SESSION['level']==3)
              {
              echo'<li><a href="department.php">department</a></li>';
              } 
              elseif($_SESSION['level']==4)
              {
              echo'<li><a href="sports_unit.php">Sports Unit</a></li>';
              } 
              elseif($_SESSION['level']==5)
              {
              echo'<li><a href="Free_education.php">Free education</a></li>';
              } elseif($_SESSION['level']==6)
              {
              echo'<li><a href="college_library.php">College Library</a></li>';
              }
               elseif($_SESSION['level']==7)
              {
              echo'<li><a href="central_library.php">Central Library</a></li>';
              } 
              elseif($_SESSION['level']==8)
              {
              echo'<li><a href="Internal_section.php">Internal_section</a></li>';
              }

             ?>
              <li><a href="logout.php">Logout</a></li>
            
            <?php
            }elseif(isset($_SESSION['admin_name']))
                {?>
                  <div class="btn-group my-info">
                  <span class="btn btn-default dropdown-toggle" data-toggle="dropdown" 
                  style="background-color: #224a63; color:#FFF;">
                  <?php echo $_SESSION['admin_name']; ?>
                  <span class="caret"></span>
                </span>
                  <ul class="dropdown-menu">
                <?php
                  echo'<li><a href="admin/dashboard.php">Division registration</a></li>';
                 ?> 
                 <li><a href="admin/logout.php">Logout</a></li>
                  <?php
     
                  
                }else{
                  echo'<a class="nav-link" href="login.php">login</a>';
                   
                   } 
              
             
               
               
               ?>
             
             
           
      </li>  
          </ul>
        </div>
      </div>
    </nav>
 <!--end navbar -->